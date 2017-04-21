@extends('master')

@section('title')
About
@stop

@section('content')
<header class="row" style="background-image:url('/images/headers/about.jpg')">
    <h1>Meet the Team</h1>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 pad-vertical">
			<div class ="row member_row">
		        <div class = "member_section col-md-6">
		            <img class="member_photo" src="/images/team/xander.jpg"/>
		            <h3 class = "member_name">Xander Gottlieb</h3>
		            <hr>
		            <h4 class = "member_role">Systems architect</h4>
		            <p>Revealing the myteries of Laravel, the Back End is Xander's baby. Ensuring efficiency and scalability, his work will ensure you find your aubergine on time.</p>
		            <a href="mailto:xander@harvest.local">xander@harvest.alexandergottlieb.com</a>
		        </div>
		        <div class = "member_section col-md-6">
		            <img class="member_photo" src="/images/team/jack.jpg"/>
		            <h3 class = "member_name">Jack Binney</h3>
		            <hr>
		            <h4 class = "member_role">Map API specialist</h4>
		            <p>Maps, barcodes and any other odd job, Jack is on it. Tinkering away with API's, all of it working perfectly, 90% of the time.</p>
		            <a href="mailto:xander@harvest.local">jack@harvest.alexandergottlieb.com</a>
		        </div>
		        <div class = "member_section col-md-6">
		            <img class="member_photo" src="/images/team/georgep.jpg"/>
		            <h3 class = "member_name"> George Price</h3>
		            <hr>
		            <h4 class = "member_role">Front-end developer</h4>
		            <p>King of HTML, Master of the Front End, however maybe a bit too friendly with breaklines. This website would be an eyesore without him.</p>
		            <a href="mailto:xander@harvest.local">georgep@harvest.alexandergottlieb.com</a>
		        </div>
		        <div class = "member_section col-md-6">
		            <img class="member_photo" src="/images/team/tom.jpg"/>
		            <h3 class = "member_name"> Tom Lafferty</h3>
		            <hr>
		            <h4 class = "member_role">Front-end developer</h4>
		            <p>Probably the least experienced of the team but more than willing to try and help out where needed. Jack of all trades, master of none is oftentimes better than master of one.</p>
		            <a href="mailto:xander@harvest.local">tom@harvest.alexandergottlieb.com</a>
		        </div>
		        <div class = "member_section col-md-6 col-md-offset-3">
		            <img class="member_photo" src="/images/team/georged.jpg"/>
		            <h3 class = "member_name">George Dinning</h3>
		            <hr>
		            <h4 class = "member_role">Back-end developer</h4>
		            <p>A valued work horse, George has occasionally found himself as Xander's intern, a noble roll for any budding web developer. Willing and able to do the 'odd jobs'.</p>
		            <a href="mailto:xander@harvest.local">georged@harvest.alexandergottlieb.com</a>
		        </div>
		    </div>
		</div>
	</div>
</div>
@stop