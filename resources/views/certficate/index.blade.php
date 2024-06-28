<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        @page{
  	size:A4 landscape;
  	margin:10mm;
}

body{
	  margin:0;
  	padding:0;
  	border:1mm solid #176B87;
  	height:188mm;
}

.border-pattern{
  	position:absolute;
  	left:4mm;
    top:-6mm;
    height:200mm;
    width:267mm;
    border:1mm solid #176B87;
  	/* http://www.heropatterns.com/ */
	  background-color: #d6d6e4;
	  background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h16v2h-6v6h6v8H8v-6H2v6H0V0zm4 4h2v2H4V4zm8 8h2v2h-2v-2zm-8 0h2v2H4v-2zm8-8h2v2h-2V4z' fill='%23991B1B' fill-opacity='1' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.content{
  	position:absolute;
  	left:10mm;
  	top:10mm;
    height:178mm;
    width:245mm;
    border:1mm solid #176B87;
  	background:white;
}

.inner-content{
	  border:1mm solid #176B87;
  	margin:4mm;
  	padding:10mm;
    height:148mm;
  	text-align:center;
}

h1{
    font-family: 'Georgia';
	text-transform:uppercase;
  	font-size:48pt;
  	margin-bottom:0;
}

h2{
    font-family: 'Algerian';
  	font-size:24pt;
  	margin-top:0;
  	padding-bottom:1mm;
  	display:inline-block;
  	border-bottom:1mm solid #176B87;
}

h2::after{
	  content:"";
  	display:block;
  	padding-bottom:4mm;
  	border-bottom:1mm solid #176B87;
}

h3{
  	font-size:20pt;
  	margin-bottom:0;
  	margin-top:10mm;
}

h4{
  	font-size:18pt;
  	margin-bottom:0;
  	margin-top:10mm;
}


p{
  	font-size:16pt;
}

.certificate_id{
  	width:40mm;
  	height:40mm;
	  position:absolute;
  	right:10mm;
  	bottom:10mm;
}

.badge{
  	width:40mm;
  	height:40mm;
	  position:absolute;
  	left:10mm;
  	bottom:10mm;
}
    </style>
</head>
<body>
  <div class="border-pattern">
      <div class="content">
          <div class="inner-content">
              <h1>CERTIFICAT DE REUSSITE</h1>
              <h3>Ce certificat est fièrement délivré à</h3>
              <p>{{ $student->name }}</p>
              <h3>Après avoir complété le cours:</h3>
              <p>{{ $course->name }}</p>
              <h3>Le</h3>
              <p>{{ date('d-m-Y') }}</p>
			  <div class="certificate_id">
				<h4>Matricule</h4>
                <small>{{ $certificate_id }}</small>
              </div>
              <div class="badge">
                <img src="{{ asset('assets/images/badge-certificate.png') }}" alt="" style="height: 100%; width: 100%;">
              </div>
          </div>
      </div>
  </div>
</body>
</html>
