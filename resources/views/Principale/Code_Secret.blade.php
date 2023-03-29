@extends('layouts.master')

@section('title')
FSDM
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Saisir le Code Secret 
        </h2>
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
              
                @if(session('error'))
                    <div onclick="this.style.display='none'" class="alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                    <form method="POST" action="{{route('verifier',['ids' =>  $ids ]) }}">
                        @csrf
                        <label for="code_saisi">Code secret :</label>
                        <input pattern="[0-9]{1,4}" type="text" name="code_saisi" id="code_saisi">
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

    </div>
</div>

@endsection


@section('scripts')

@endsection