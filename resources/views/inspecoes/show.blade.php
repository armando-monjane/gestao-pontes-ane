@extends('layouts.master')


@section('title')
    Detalhes de Inspecções de ponte
@endsection

@section('css')
    <style>

    </style>
@endsection


@section('content')
    <h4 class="center-align">Inspecção da ponte {{$inspecao->ponte->nome_ponte}} <span class="badge blue left white-text">{{$inspecao->data}}</span></h4>

    <div class="card">
        <div class="card-content white-text">
            <span class="card-title">Realizada por {{$inspecao->user->name}}</span>
        </div>
    </div>

    <div class="divider"></div>
    <div class="section">
        <div id="app">
            <inspecao-report id="{{$inspecao->id}}"></inspecao-report>
        </div>
    </div>

@endsection

@section('js')
    <script src="/js/app.js"></script>
@endsection