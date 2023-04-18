<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use \App\Models\User;
use \App\Models\Module;
use \App\Models\Note;

class EnsureSecretCodeIsValid
{
    /**
     * Manipule une demande entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $ids =  $request->route('ids');
            $user = Auth::user();
            $module = $user->responsabilites()->first()->module;
            $code_secret_db = $module->code_secret;
            $code_saisi = $request->get('code_saisi');

            if ($code_saisi == $code_secret_db) {
                $module_name = $module->Intitule;
                $user_name = $user->name;
                $user_id = $user->id;
                $SESSION = ($ids == 1) ? "Normale" : "Rattrapage";
                $variables = [
                    'ids' => $ids,
                    'SESSION' => $SESSION,
                    'module_name' => $module_name,
                    'user_name' => $user_name,
                ];
                    $request->merge($variables);
                return $next($request);
            } else {
                return redirect()->route('codeS', ['ids' => $ids]) ->with('error', 'Le code que vous avez saisi est incorrect.');
            }
        }
    }
}