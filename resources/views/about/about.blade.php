@extends('master')

@section('title')
About
@stop

@section('content')
<header class="row" style="background-image:url('/images/headers/about.jpg')">
    <h1>How we Started</h1>
    <h2>Meet the Team</h2>
    <div class ="member_row form-inline col-md-10 col-md-offset-1">
        <div class = "member_section col-lg-6">
            <img class="member_photo col-lg-3" src="/images/team/xander.jpg"/>
            <h3 class = "member_name">Alexander Gottleib.</h3>
            <hr>
            <h4 class = "member_role">Systems architect</h4>
        </div>
        <div class = "member_section col-lg-6">
            <img class="member_photo col-lg-3" src="/images/team/jack.jpg"/>
            <h3 class = "member_name">Jack Binney.</h3>
            <hr>
            <h4 class = "member_role">Map API specialist</h4>
        </div>
        <div class = "member_section col-lg-6">
            <img class="member_photo col-lg-3" src="/images/team/georgep.jpg"/>
            <h3 class = "member_name"> George Price. </h3>
            <hr>
            <h4 class = "member_role">Front-end developer</h4>
        </div>
        <div class = "member_section col-lg-6">
            <img class="member_photo col-lg-3" src="/images/team/tom.jpg"/>
            <h3 class = "member_name"> Tom Lafferty. </h3>
            <hr>
            <h4 class = "member_role">Front-end developer</h4>
        </div>
        <div class = "member_section col-lg-6 col-lg-offset-3">
            <img class="member_photo col-lg-3" src="/images/team/georged.jpg"/>
            <h3 class = "member_name">George Dinning</h3>
            <hr>
            <h4 class = "member_role">Back-end developer</h4>
        </div>
    </div>

</header>
@stop