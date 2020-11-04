<?php
/**
 * Praktikum DBWT. Autoren:
 * Lukas, Gonnermann, 3218299
 * Hamdy, Sarhan, 3251443
 */

const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';

/**
 * Sprachen
 */
$de = [
    'gericht' => 'Gericht',
    'allergene' => 'Allergene',
    'bewertungen' => 'Bewertungen (Insgesamt',
    'filter' => 'Filter',
    'hier_suchen' => 'Hier suchen!',
    'suchen' => 'Suchen',
    'text' =>'Text',
    'autor' =>  'Autor',
    'sterne' => 'Sterne',
    'sprache' => 'Sprache',
    'deutsch' => 'Deutsch',
    'englisch' => 'Englisch',
];

$en = [
    'gericht' => 'Meal',
    'allergene' => 'Allergens',
    'bewertungen' => 'Rating (Total',
    'filter' => 'Filter',
    'hier_suchen' => 'Search here!',
    'suchen' => 'Search',
    'text' =>'Text',
    'autor' =>  'Author',
    'sterne' => 'Stars',
    'sprache' => 'Language',
    'deutsch' => 'German',
    'englisch' => 'English',
];

/**
 * Default Sprache Deutsch, wenn über GET Parameter sprache übertragen wird wird diese verwendet
 */
$lang = [];
if (!isset($_GET['sprache'])) {
    $lang = $de;
}
elseif ($_GET['sprache'] == 'de') {
    $lang = $de;
}
elseif ($_GET['sprache'] == 'en') {
    $lang = $en;
}
else {
    $lang = $de;
}


/**
 * Liste aller möglichen Allergene.
 */
$allergens = array(
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
);  // Fehlende Klammer eingefügt

$meal = [ // Kurzschreibweise für ein Array (entspricht = array())
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        // Changed strpos to stripos for case insensitive searching
        if (stripos($rating['text'], $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {    // else korrigiert
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

$showDescriptions = "";
if ($_GET['show_description'] == true) {
    $showDescriptions = $meal['description'];
}

$searchTerm = "";
if ($_GET['search_text']) {
    $searchTerm = $_GET['search_text'];
}

function calcMeanStars($ratings) : float { // : float gibt an, dass der Rückgabewert vom Typ "float" ist
    $sum = 0;
    $i = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
        $i++;
    }
    return $sum / $i;
}

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $lang['gericht'] . ': ' . $meal['name']; ?></title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <h1><?php echo $lang['gericht'] . ': ' . $meal['name']; ?></h1>
        <p><?php
            echo $showDescriptions;
            ?></p>
        <h1><?php echo $lang['allergene'] . ': '?></h1>
        <ul>
            <?php
                foreach ($allergens as $allergen => $alval) {
                    echo "<li>$alval</li>";
                }
            ?>
        </ul>
        <h1><?php echo $lang['bewertungen'] . ' ' . calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text"><?php echo $lang['filter'] . ': ' ?></label>
            <input id="search_text"
                   type="text"
                   name="search_text"
                   value="<?php echo htmlspecialchars($searchTerm)?>"
                   placeholder="<?php echo htmlspecialchars($lang['hier_suchen'])?>">
            <input id="description_checkbox" name="show_description" type="checkbox" value="checked">
            <input type="submit" value="<?php echo $lang['suchen']; ?>">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td><?php echo $lang['text'] ?></td>
                <td><?php echo $lang['autor'] ?></td>
                <td><?php echo $lang['sterne'] ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class = 'rating_text'>{$rating['author']}</td>  
                      <td class='rating_stars'>{$rating['stars']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>
<footer>
    <div>
        <div><?php echo $lang['sprache'] . ':' ?></div>
        <a href="meal.php?sprache=de"><?php echo $lang['deutsch'] ?></a>
        <a href="meal.php?sprache=en"><?php echo $lang['englisch'] ?></a>
    </div>

</footer>
</html>