
function redirige()
{
    document.location="compte.php";
} 

function changeDate(jour, mois, annee)
{
    if (mois < 10 && mois != 0)
        mois = '0' + mois;

    if (jour < 10 && jour != 0)
        jour = '0' + jour;
    
    document.location="index.php?jours=" + jour + "&mois=" + mois + "&annee=" + annee;
}
