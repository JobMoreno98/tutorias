@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <div class="container">

    
    <table class="table table-dark table-striped mt-4">
        <thead>

        </thead>
        <tbody>

        <!-- Content Column -->
        <div class="col-lg-9 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-9">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">Resultados de las Encuestas realizadas a los Alumnos</h2>
                </div>
                <div class="card-body">
                    <h4>Alumnos que cuentan con Empleo<span
                                class="float-right"> {{$porempleo}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width:{{$porempleo}}%"></div>
                    </div>

                    <h4>Alumnos que cuentan con Computadora<span
                                class="float-right"> {{$porcompu}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$porcompu}}%"></div>
                    </div>


                    <h4>Alumnos que cuentan con el Apoyo de su Familia <span
                                class="float-right"> {{$porapoyoFamilia}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porapoyoFamilia}}%"></div>
                    </div>

                    <h4>Alumnos que cuentan con Internet en Casa<span
                                class="float-right"> {{$porinternetEnCasa}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porinternetEnCasa}}%"></div>
                    </div>

                    <h4>Alumnos que cuentan con Computadora Adecuada<span
                                class="float-right"> {{$porcomputadoraAdecuada}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porcomputadoraAdecuada}}%"></div>
                    </div>

                    <h4>Alumnos que cuentan con Hábitos Alimenticios<span
                                class="float-right"> {{$porhabitosAlimenticios}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porhabitosAlimenticios}}%"></div>
                    </div>

                    <h4>Alumnos que practican algún Deporte<span
                                class="float-right"> {{$pordeportes}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$pordeportes}}%"></div>
                    </div>

                    <h4>Alumnos que cuentan con Enfermedades<span
                                class="float-right"> {{$porenfermedad}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porenfermedad}}%"></div>
                    </div>

                    <h4>Alumnos que presentan alguna discapacidad<span
                                class="float-right"> {{$pordiscapacidad}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$pordiscapacidad}}%"></div>
                    </div>
{{--
                    <h4>Alumnos que han sufrido de Acoso Sexual<span
                                class="float-right"> {{$poracosoSexual}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$poracosoSexual}}%"></div>
                    </div>

                    <h4>Alumnos que han sufrido de Acoso Sexual en la UdG<span
                                class="float-right"> {{$poracosoSexualUdG}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$poracosoSexualUdG}}%"></div>
                    </div>

                    <h4>Alumnos que necesitan Atención Psicológica<span
                                class="float-right"> {{$poratencionPsicologica}}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$poratencionPsicologica}}%"></div>
                    </div>

--}}
                </div>
            </div>
        </tbody>
    </table>
</div>
@endsection
