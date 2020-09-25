if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['typeOfEvents']))){
    $type = $_POST['typeOfEvents'];
    $activityAll = array();

    $appartenir = new appartenir();
    $appartenir->typeOfEvents_id = $type;
    $activityAll = $appartenir->getActivity();
    echo json_encode($activityAll);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['ville_code_postal']))){
    $cpField = $_POST['ville_code_postal'];
    $villes = array();

    $villes_france = new villes_france();
    $villes_france->ville_code_postal = $cpField;
    $villes = $villes_france->getVilles();
    echo json_encode($villes);
    exit();
}

$activityOfEvents_id = trim(filter_input(INPUT_POST, 'activityOfEvents', FILTER_SANITIZE_NUMBER_INT));
    if (empty($activityOfEvents_id)) {
        $errors['activityOfEvents'] = 'Veuillez renseigner  la l\'activité de l\évènement';
     }
    array_push($post,$activityOfEvents_id);