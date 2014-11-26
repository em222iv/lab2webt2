<h1>Lab 2</h1>

<a href="http://eerie.se/lab2webt2/1DV449_L02/index.php">Körbar länk</a>
<h2>Del 1</h2>
<h4>Redogör för det säkerhetshål du hittat</h4>

<ul> 
<li>Ingen logik vid inlog, man kan logga in med vad som helst. Alltså komma åt mess sidan genom att bara skriva in den i URLen.</li>
<li>Man kan skriva in taggar i fälten, även i chatten.</li>
<li> lösenord förvaras ohaschade i databasen</li>
<li> känslig mot CSRF attacker</li>
<li> Databasen "db.db" går att ladda ner från roten, om man kan länken.</li>
</ul>

<h4>Redogör för hur säkerhetshålet kan utnyttjas</h4>
<ul> 
<li> Du kan skjuta in scripts eller sql-injektions.</li>
<li> Man kan hämta ut och se användarinformation från databasen</li>
<li> Det kan utföras oönskade handlingar från elaka användare </li>
<li> Elaka användare kan komma åt och se hur databasen är uppbygd</li>
</ul>

<h4>Vad för skada kan säkerhetsbristen göra?</h4>
<ul> 
<li> SQL-injektions kan förstöra databasen. Scrits och skjutas in i form av t.ex. länkar för andra användare. Denna länk kan vara kopplat till något helt annat än vad länkentexten säger. </li>
<li> Illasinnade användare kan missbruka andras konton</li>
<li> Databsen kan bara utge information om databasen. Det går inte på något sätt att komma åt eller påverka själva databasfilen på webbhotelet</li>
</ul>

<h4>Hur du har åtgärdat säkerhetshålet i applikationskoden?</h4>
<p>
Jag har implementerat pdo vid inlogg(sec.php) som tar hand om sql injections genom parametisering. För att inloggningen skulle fungera så satt vi också en return true/false sats för att avgöra om inloggningsuppgifterna stämde.</p>
<p>Jag kör också strip_tags() på input för att försäkra mig om att det inte kommer in taggar.</p>

<p>Jag använder mig av password_hasch/verify för att hascha lösenorden i databasen.</p>

<p>Jag ger användaren ett token varenda gång denne loggar in. Detta token måste stämma överens vid vid en post </p>

<p>Tack vare tidigare åtgärder kan man inte påverka databsen trots att det går att ladda själv och se struktur och innehåll. Det kan ses mer som en läcka av information än en säkerthetsläcka för själva chatten. Detta borde åtgärdas genom att göra en sql databas hos webhotellet istället för att köra sqllite db som sparas i roten </p>


<h2>Del 2</h2>
<h4>Namn på åtgärd Du gjort för att försöka förbättra prestandan</h4>
<dl>
  <dt>Front End</dt>
    <dd>- flyttat CSS kod till CSS.filer</dd>
    <dd>- Gör inte inödiga kall på filer</dd>
     <dd>- Bytt ut ramverksfiler mot minifierade varianter</dd>
    <dd>- </dd>
  <dt>Back End</dt>
    <dd>- Man kan inte posta fält med endast whitespace</dd>
    <dd>- Tagit bort onödiga filer</dd>
    <dd>- Tagit bort död kod</dd>
    <dd>- </dd>
</dl>


<h4>Teori kring åtgärden (förklara varför du implementerar den och vad säger teorin om vad denna åtgärd gör). Referens till vart du hittat denna teori ska anges!</h4>
<p>
I HTML koden vill jag försöka få ner laddningstid genom att plocka bort onödiga inlänkingar av filer och flyttat samtlig css kod till css-filer.

Det finns
</p>

<h4>Observation (laddningstid, storlekar av resurser, anrop m.m.) innan åtgärd (utan webläsar-cache - gärna ett medeltal av ett antal testningar)</h4>

<p>Om man gör mätningar på projektet i den form man får den så ligger storlek vid neddladning runt 720kb.
Efter att ha plockat undan död kod och flyttat rynt css-kod till separata filer så hade jag endast sparat in några få byte.
De riktiga förbättringarna såg man när man ändrade på inlänkningar och vilka filer som länkas in, och vart de länkas in.</p>

<p>Mätningar av tiden är varierande på från försök till försök och mellan webbläsare. Men några medeltal efter ca 5 tester av efter varje optimering.

<p>Inlogg efter endast ha skrivit ett inlägg i chatten : <bold>684ms.</bold></p>

<p>Ladda om sidan utan optimering och med ett inlägg :</p>




</p>

<h4>Observation (laddningstid, storlekar av resurser, anrop m.m.) efter åtgärd (utan webläsar-cache - gärna ett medeltal av ett antal testningar)
Reflektion kring att testresultatet blev som det blev.</h4>

<p>Efter att ha tagit bort onödiga js och css filer och bytt ut visa mot minfierade varianter så har nu storleken minskat till ca 180kb.</p>

<p>Inlogg efter att ha tagit bort dökod i js och ändrat css : 679ms.</p>
<p>Inlogg efter att ha ändrat inläkningar och lagt in minifierade css och js filer : 616ms.</p>



<h2>Del 3</h2>

<h4>Sista skrivna meddelandet ska hamna högst upp i meddelandelistan</h4>
<p>
Fixat genom att hämta ut meddelande BY DESC
</p>




<h4>Bara de nya meddelanden som inte tidigare skickas ut till klienten ska skickas ut vid en uppdatering.</h4>
<p>
Fixat genom att skriva en separat funktion som endast hämtar meddelande med senast tid inlagd
</p>

<h4>Du förklarar din implementation i din laborationsrapport samt reflekterar över de för- och nackdelar som finns med en denna lösning.</h4>
<p>
Jag skrev om getMessages funktion som redan fanns implementerad och satt ett intervall på den. Alltså polling
I getMessages klassen i php, som JS funktionen kallar på, så gör den ett eget interval på 20sekunder
där den ligger uppe och väntar på att något nytt ska hända i databasen.
</p>
<p>Man håller alltså kommunikation öppen mot databsen hela tiden, vilket kanske inte är så bra då det kan ta en del prestanda.</p>
<p>Fördelen med polling är ju att man kan hålla uppe realtidskommunikation</p>

