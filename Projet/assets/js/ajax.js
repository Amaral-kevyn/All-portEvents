
cpField = document.getElementById("ville_code_postal");
cpField.addEventListener("keyup", getVilles);

function getVilles(){
    let search = this.value;

    let monForm = new FormData();
    monForm.append("ville_code_postal",search);

    if(search.length>=5){
        //Appel Ajax pour récupérer un tableau de villes correspondant au cp (search)
        let param = {
            method: 'POST',
            body: monForm
        }
        fetch('createEvents_ctrl.php',param)
        .then(function(response) {
            return response.json();
        })
        .then(function(villes) {
            let options = '';
            villes.forEach(function(ville){
                options += '<option value="'+ville.ville_nom+'">'+ville.ville_nom+'</option>';
            })
            document.getElementById("ville_nom").innerHTML = options;
        })
    }
}


type = document.getElementById("typeOfEvents");
type.addEventListener("change", getActivity);

function getActivity(){
    let search = this.value;

    let monFormActivity = new FormData();
    monFormActivity.append("typeOfEvents",search);

    //Appel Ajax pour récupérer un tableau d'activité' correspondant au type (search)
    let param = {
        method: 'POST',
        body: monFormActivity
    }
    fetch('createEvents_ctrl.php',param)
    .then(function(response) {
        return response.json();
    })
    .then(function(activityAll) {
        let options = '';
        activityAll.forEach(function(activity){
            options += '<option value="'+activity.activityOfEvents_id+'">'+activity.activity+'</option>';
        })
        document.getElementById("activityOfEvents").innerHTML = options;
    })
}
