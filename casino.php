<?php 
/**
 * Plugin Name: Casino
 */

add_action('admin_menu', 'CasinoPlugin');

function CasinoPlugin() {
    add_menu_page('Online Casinos', 'Casino', 'manage_options', 'casinos-page', 'CasinoPageHTML');
}

function CasinoPageHTML(){
?>
<html>
    <head>
    <script type="text/javascript">
// Get data from API
async function fetchAsync(url) {
    let response = await fetch(url);
    let data = await response.json();
    // Get number of casinos
    let nrC = JSON.stringify(data.toplists[575].length);
    let tab = document.getElementById("tabela");

    let objs = new Array();
    // Add the casinos to the table
    for (i = 0; i < nrC; i++) {
        // Turn JSON data to objects
        objs.push(data.toplists[575][i]);
    }
    // Sort by position
    objs.sort((a, b) => a.position - b.position);

    // Debug 
    /*
       objs.forEach(function(obj){
        console.log("position"+obj.position);
       });*/

    for (j = 0; j < objs.length; j++) {
        // Add table rows
        let tabrow = document.createElement("tr");
        tab.appendChild(tabrow);

        // Casino
        let col1 = document.createElement("td");
        col1.className="casinotd";
        tabrow.appendChild(col1);
        // Logo
        let logo = document.createElement("img");
        col1.appendChild(logo);
        logo.src = objs[j].logo.replaceAll('"', '');
        // URL
        let link = document.createElement("a");
        let linkname = document.createTextNode("Review");
        link.appendChild(linkname);
        link.href = window.location.href + "/" + objs[j].brand_id.replaceAll('"', '');
        col1.appendChild(link);

        // Bonus
        let col2 = document.createElement("td");
        col2.className="bonustd";
        tabrow.appendChild(col2);
        // Stars
        let nstars = objs[j].info.rating;
        let stars = document.createElement("img");
        stars.src = "http://localhost/wp-content/uploads/2022/11/"+nstars+".png";
        col2.appendChild(stars);
        // Bonus
        let bonus = document.createElement("h3");
        let bonustxt = document.createTextNode(objs[j].info.bonus);
        bonus.appendChild(bonustxt);
        col2.appendChild(bonus);


        //Features
        let col3 = document.createElement("td");
        col3.className="featurestd";
        tabrow.appendChild(col3);
        let features = objs[j].info.features.toString().split(',');
        for(h=0;h<features.length;h++){
            let feature = document.createElement("div");
            let featuretxt = document.createElement("h4");
            let featuretext = document.createTextNode(features[h]);
            featuretxt.appendChild(featuretext);
            let check = document.createElement("img");
            check.src="http://localhost/wp-content/uploads/2022/11/check.png";
            feature.appendChild(check);
            feature.appendChild(featuretxt);
            col3.appendChild(feature);
        }

        // Play
        let col4 = document.createElement("td");
        col4.className="playtd";
        tabrow.appendChild(col4);
        let btn = document.createElement("a");
        let btntxt = document.createTextNode("PLAY NOW");
        btn.appendChild(btntxt);
        btn.href = objs[j].play_url.replaceAll('"', '');
        col4.appendChild(btn);
        let tac = document.createElement("div");
        tac.innerHTML = objs[j].terms_and_conditions;
        col4.appendChild(tac);

        // Add the bar 
        let bar = document.createElement("hr");
        tabrow.after(bar);
    }
}
    </script>
    <meta charset="utf-8">
    <title>Raketech Exercise</title>
    <link href="style.css" rel="stylesheet"/>
    </head>
    <body>
    <?php
    echo "<script type='text/javascript'>fetchAsync('http://localhost/wp-json/wl/v1/posts');</script>";?>
        <div style="background-color:#200404">
            <table>
            <tbody id="tabela">
                <tr id = "thtr">
                    <th>Casino</th>
                    <th>Bonus</th>
                    <th>Features</th>
                    <th>Play</th>
                </tr>
                </tbody
            </table>
        </div>
    </body>
</html>


	<style type='text/css'>
	#tabela {
    background-color: #FFFFFF;
    }
table {
    width: 80%;
    display: block;
    margin: auto;
    border-collapse: collapse;
}
#thtr {
    background-color: #d89c34;
    font-size: 20px;

}
#thtr th {
    padding:20px;
}
td {
    width: 25%;
    height:180px;
    
}
td.casinotd img {
    display: block;
    width: 80%;
    margin: auto;
}
.casinotd a {
    font-size: 17px;
    text-align: center;
    display: flex;
    justify-content: center;
    margin-top: 10px;
}
.bonustd img {
    display: block;
    margin: auto;
}
.bonustd h3 {
    display: block;
    text-align: center;
    font-size: 19px;
}
.featurestd h4 {
    font-size: 15px;
    margin-top: 5px;
}
.featurestd img {
    width: 30px;
    height: 30px;
}
.playtd a {
    background-color: #106c2c;
    color: white;
    font-size: 26px;
    font-weight: 500;
    padding: 23px 40px;
    border-radius: 16px;
    display: block;
    width: fit-content;
    margin: auto;
    margin-bottom: -20px;
}
.playtd div a {
    background-color: transparent;
    color: darkred;
    font-size: unset;
    font-weight: unset;
    padding: unset;
    border-radius: unset;
    display: unset;
    width: unset;
    margin: unset;
    margin-bottom: unset;
}
.featurestd div {
    display: flex;
    margin-left: 22%;
}
.playtd div {
    text-align: center;
    margin-top: 30px;
}
hr {
    width: 100%;
    margin: 0px;
    border: 1px solid black;
}
@media screen and (max-width: 1500px) {
    .playtd a {
        background-color: #106c2c;
        color: white;
        font-size: 18px;
        font-weight: 500;
        padding: 18px 30px;
        border-radius: 16px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: -20px;
    }
    .playtd div {
    text-align: center;
    margin-top: 30px;
    font-size: 11px;
}
.featurestd div {
    display: flex;
    margin-left: 10%;
}
.featurestd h4 {
    font-size: 13px;
    margin-top: 2px;
}
.featurestd img {
    width: 25px;
    height: 25px;
}
.bonustd h3 {
    display: block;
    text-align: center;
    font-size: 14px;
}
}
@media screen and (max-width: 1000px) {
    .playtd a {
        background-color: #106c2c;
        color: white;
        font-size: 11px;
        font-weight: 500;
        padding: 13px 20px;
        border-radius: 16px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: -20px;
    }
    .playtd div {
    text-align: center;
    margin-top: 30px;
    font-size: 9px;
}
.featurestd h4 {
    font-size: 9px;
    margin-top: 0px;
}
.featurestd img {
    width: 20px;
    height: 20px;
}
.bonustd img {
    display: block;
    margin: auto;
    width: 80%;
}
.bonustd h3 {
    display: block;
    text-align: center;
    font-size: 9px;
}
.casinotd a {
    font-size: 12px;
    text-align: center;
    display: flex;
    justify-content: center;
    margin-top: 10px;
}
td {
    width: 25%;
    height: 150px;
}
#thtr {
    background-color: #d89c34;
    font-size: 14px;
}
}
@media screen and (max-width: 500px) {
    table {
        width: 100%;
        display: block;
        margin: auto;
        border-collapse: collapse;
    }
}



<?php
}
?>