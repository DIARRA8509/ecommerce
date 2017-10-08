
	<link rel="icon" type="img/jpg" href="<?php echo RACINE_SITE .'img/commun/icone-2sdti.jpg';?>" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'inc/css/animate.css';?>">
	<link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'inc/css/main.css';?>">
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 1199px)" href="<?php echo RACINE_SITE .'inc/css/mediaquery.css';?>">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Poppins:500,600,700" rel="stylesheet"> 
</head>
<body>
	<div class="container" style="min-height: 75vh;" >
		<header>
			<div class="row" id="haut">
				<div class="col-md-5 col-sm-5 col-xs-5">
					<a href="<?php echo RACINE_SITE.'index.php';?>" id="logo-header"><img src="<?php echo RACINE_SITE .'img/commun/logofinal6.png';?>" alt="Logo de la société 2SDTI"></a>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-7 police">
					<div id="header-adresse">
						<p id="p1">Transferts d'entreprises - Déménagements</p>
						<p id="p2">Garde-meubles - Recyclage</p>
						<p id="p3">56 rue & 5, passage des Acacias - 75017 PARIS</p>
						<p id="p4">01 75 77 30 50 - <a href="mailto:contact@2sdti.com">contact<span id="arobase">@</span>2sdti.com</a></p>				
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p class="police" id="p4bis"><a href="tel:0175773050">01 75 77 30 50</a> -- <a href="mailto:contact@2sdti.com">contact@2sdti.com</a></p>
				</div>
			</div>
			<div class="navbar clearfix" role="navigation" id="menuHide">
				<div class="navbar-header" style="margin-left:25px;">
					<button type="button" class="navbar-toggle collapsed navbar-inverse" data-toggle="collapse" data-target="#menuPortable" style="width: 100%;" id="boutonMenu">
					<span style="visibility: initial;color: #fff; font-size: 20px;margin-top: 13px;">Menu</span>
						<span class="sr-only">Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse main-nav navbar-inverse" id="menuPortable">
					<ul class="nav navbar-nav" id="menuTel">
						<li><a href="<?php echo RACINE_SITE.'index.php';?>">Accueil</a></li>
						<li><a href="<?php echo RACINE_SITE.'prestations.php';?>">Prestations</a>
							<ul>
								<li><a href="<?php echo RACINE_SITE.'transferts.php';?>">Transferts d'entreprises</a></li>
								<li><a href="<?php echo RACINE_SITE.'gardemeubles.php';?>">Garde-Meubles</a></li>
								<li><a href="<?php echo RACINE_SITE.'demenagements.php';?>">Déménagement particulier</a></li>
							</ul>
						</li>
						<li><a  href="<?php echo RACINE_SITE.'ecobox.php';?>">Eco-box 2sdti</a></li>
		                <li><a href="<?php echo RACINE_SITE.'devis.php';?>">Devis</a></li>	
						<li><a href="<?php echo RACINE_SITE.'connexion.php';?>">Mon compte</a></li> 
					</ul>
				</div><!-- /.navbar-collapse -->
			</div> <!-- fin div menuHide -->
			<nav>				
				<div class="row">
					<div class="col-md-12">
						<ul id="menuNav">
							<li class="animCamion camionOut" id="m5"><span>Mon compte</span></li>
							<li class="animCamion camionOut" id="m4"><span>Devis</span></li>
							<li class="animCamion camionOut" id="m3"><span>Eco-box 2sdti</span></li>
							<li class="animCamion camionOut" id="m2"><span>Prestations</span></li>
							<li class="animCamion camionOut" id="m1"><span>Accueil</span></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-bottom: -10px;">
						<div style="position:relative; z-index: 2;" id="menuBare">
							<ul id="menu">
								<li class="animMenu" id="m1b"><a href="<?php echo RACINE_SITE.'index.php';?>">Accueil</a></li>
								<li class="animMenu" id="m2b"><a href="<?php echo RACINE_SITE.'prestations.php';?>">Prestations</a>
									<ul>
										<li><a href="<?php echo RACINE_SITE.'transferts.php';?>">Transferts d'entreprises</a></li>
										<li><a href="<?php echo RACINE_SITE.'gardemeubles.php';?>">Garde-Meubles</a></li>
										<li><a href="<?php echo RACINE_SITE.'demenagements.php';?>">Déménagement particulier</a></li>
									</ul>
								</li>
	                        	<li class="animMenu" id="m3b"><a href="<?php echo RACINE_SITE.'ecobox.php';?>">Eco-box 2sdti</a>
								</li>
								<li class="animMenu" id="m4b"><a href="<?php echo RACINE_SITE.'devis.php';?>">Devis</a></li>
								<li class="animMenu" id="m5b"><a href="<?php echo RACINE_SITE.'connexion.php';?>">Mon compte</a></li> 
							</ul>
						</div>
					</div>
				</div>
			</nav>		
		</header>		
		