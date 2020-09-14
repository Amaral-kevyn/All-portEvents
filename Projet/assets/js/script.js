let inscript = document.querySelector('.inscript');
    let formInscription = document.querySelector('.formIn');
    let connected = document.querySelector('.connected');
    let formConnected = document.querySelector('.formConnexion');
    let imgProfile = document.querySelector('.imgProfile');

    inscript.addEventListener('click', function () {
        formInscription.classList.toggle("d-none");
        inscript.classList.toggle("placementInscription");
    });

    connected.addEventListener('click', function () {
        formConnected.classList.toggle("d-none");
        imgProfile.classList.toggle("d-none");
        connected.classList.toggle("placementConnected");
    });
 
     if (window.matchMedia("(max-width: 600px)").matches) {
        connected.classList.toggle("placementConnected");
        inscript.classList.toggle("placementInscription");
} 


		/* $("input[name='password']").focus(function(){
			$("#forcePassword").slideDown();
		}) */

		// selectionne un élément et affique la fonction au keyup
		$("input[name='password']").keyup(function () {
            // prend la value du selecteur choisi prÃ©cÃ©dement
            var password = $(this).val();
            var force = 0;

            // vÃ©rifie que la regex est true ou false
            // var regex = (/(?=.*[a-z])/).test(password);

            // vÃ©rifie que la value de l'input contient des lettres
            // Si c'est le cas, la force prend +1
            if (password.match(/(?=.*[a-z])/) || password.match(/(?=.*[A-Z])/)) {
                force++;
            }

            // vÃ©rifie que la value de l'input contient des chiffres
            if (password.match(/(?=.*[0-9])/)) {
                force++;
            }

            // vÃ©rifie que la value de l'input contient des caractÃ¨res spÃ©ciaux
            if (password.match(/(?=.*\W)/)) {
                force++;
            }


            // vÃ©rifie que le password contient au moins 8 caractÃ¨res
            if (password.length >= 8) {
                force++;
            }

            // couleur en fonction de la force
            var textForce = $("#force");
            // couleur et texte en fonction de la force
            if (force == 1) {
                var bgColor = '#dc3545';
                textForce.text('Faible');
            } else {
                if (force == 2) {
                    var bgColor = '#ffc107';
                    textForce.text('Moyen');
                } else {
                    if (force == 3) {
                        var bgColor = '#28a745';
                        textForce.text('Fort');
                    } else {
                        if (force == 4) {
                            var bgColor = '#0d6e25';
                            textForce.text('Très fort');
                        }
                    }
                }
            }
            document.getElementById('progress').style.backgroundColor = bgColor;
            document.getElementById('progress').style.width = 25 * force + '%';

            //document.getElementById('progress').setAttribute('style', 'width:'+25*force+'%; background-color: '+bgColor);

            // change le css de la progressbar
            /*  $("#progress").css({
            	'width': 25*force+'%',
            	'background-color': bgColor
            });  */
        })
        // fait disparaitre la progressbar quand on quitte le champ password
        $("input[name='password']").blur(function () {
            $("#forcePassword").slideUp();
        })
        // Fait apparaitre la progressbar quand on focus le champ password
        document.querySelector(`input[name="password"]`).addEventListener('focus', function () {
            let forcePassword = $("#forcePassword").slideDown();
        })

        /* $("input[name='password']").focus(function(){
        	$("#forcePassword").slideDown();
        }) */

        $(function () {
          $('#navbarSupportedContent').on('click', '.nav-item', function () {
              $('#navbarSupportedContent').toggleClass('show');
          })})