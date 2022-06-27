<?php
$pokemonNB = 0;

$headers = [
    "Authorization: token 7099e581-926c-4d11-9801-07cdf9da0872"
];

$api = curl_init("https://api.pokemontcg.io/v2/cards/");

curl_setopt_array($api, [
    CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5
]);
curl_setopt($api, CURLOPT_HTTPHEADER, array(
    "X-API-Key: 7099e581-926c-4d11-9801-07cdf9da0872",
    "customer-header2:value2"));

$data = curl_exec($api);
if($data === false){
    var_dump(curl_error($api));
}else {
    $data = json_decode($data, true);

    foreach($data ['data'] as $poke){
        echo ("<div class = poke>");
        echo ("<img src =" . $data ['data']["$pokemonNB"]['images']['large'] . ">");
        echo ("<div class = price>");
        echo("<p>Informations de la carte : </p>");
        echo("<p>Nom : " . $data ['data']["$pokemonNB"]['name'] . "</p>");
        echo("<p>Artiste : " . $data ['data']["$pokemonNB"]['artist'] . "</p>");
        echo("<p>Serie : " . $data ['data']["$pokemonNB"]['set']['series'] . "</p>");

        if (empty($data ['data']["$pokemonNB"]['rarity'])){
            echo("<p>Rareté : Unknow</p>");
        }else{
            echo("<p>Rareté : " . $data ['data']["$pokemonNB"]['rarity'] . "</p>");
        }

        echo("<p>Pokédex : " . $data ['data']["$pokemonNB"]['nationalPokedexNumbers']['0'] . "</p>");
        echo("<p>Tendance des prix (derniere update " . $data ['data']["$pokemonNB"]['cardmarket']['updatedAt'] . ") : " . $data ['data']["$pokemonNB"]['cardmarket']['prices']['trendPrice'] . "€</p>");
        echo ("</div>");
        echo ("</div>");
        // var_dump ($data ['data']["$pokemonNB"]['nationalPokedexNumbers']['0']);

        $pokemonNB = $pokemonNB + 1;
    }
}
curl_close($api);


?>