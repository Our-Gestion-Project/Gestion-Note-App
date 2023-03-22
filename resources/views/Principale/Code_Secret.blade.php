<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Saisir le Code Secret 
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{route('verifier',['ids' =>  $ids ]) }}">
                        @csrf
                        <label for="code_saisi">Code secret :</label>
                        <input type="text" name="code_saisi" id="code_saisi">
                        <button type="submit">Valider</button>
                    </form>

       {{--     <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
       </div>
       --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>