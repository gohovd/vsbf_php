# Vike Småbåtforening
Web prosjekt med HTML/CSS/JS i front og PHP bak.

## Funksjonelle krav
### Prioritert
- Hammer.js for swiping
- Galleri og bildeopplasting
- Epost: innsending skjema, abonner, send ut til abonnenter skjema
- Admin CMS side (bruker oversikt, etc..)
#### Brukere
+ Som admin kunne lese, endre, slette, lage brukere.
+ Aktivere konto via mail link
+ Admin sende epost (som kasserer, support, ..)
+ Abonnere på nyhetsbrev
+ Tilbakestille passord via mail link
+ Aktivering av konto åpner ekstra funksjonalitet
+ Aktiverte brukere kan kommentere
+ Brukere kan logge inn med Facebook profil
+ Brukere kan logge inn med Google profil

#### System
+ Captcha i registrerings-skjema
+ Bruk av cookies
+ Annonsere bruk av cookies
+ Kontaktskjema
+ Værmelding (https://api.met.no/weatherapi/)
+ JS Ruter
+ Bilde opplasting
+ Interaktiv båtplass velger og oversikt
+ Gjestebrygge-/bobil-plass bookingsystem
+ Tema skifte
+ Bruk av /js/show-message.js; tilbakemelding til bruker på handling

# Oppsett
## 1. Installer Web Server
Velg og installer én - også klon repository inn i hosting directory.

<table style="text-align:left;">
    <tr>
        <th>OS</th>
        <th>Download</th>
        <th>Hosting directory</th>
    </tr>
    <tr>
        <td>Windows</td>
        <td><a href="http://www.wampserver.com/en/">Wamp</a></td>
        <td>C:\wamp64\www\</td>
    </tr>
    <tr>
        <td>Mac</td>
        <td><a href="https://www.mamp.info/en/mac/">Mamp</a></td>
        <td>/Applications/MAMP/htdocs/</td>
    </tr>
</table>

`cd path/to/hosting/directory`

`git clone git@github.com:gohovd/vsbf_php.git`

## 2. Navigasjon
Linkene avhenger av en variabel i __head.php__ og __config.php__ kalt `$baseUrl`, den skal se ut som under:

`<?php $baseUrl = "/vsbf_php"; ?>`

## 3. Database
### 3.1 Lag ny database i phpMyAdmin
Finn _phpMyAdmin_ (http://localhost:8888/phpMyAdmin/) og lag en ny database kalt __vikesbf__.

### 3.2 Konfigurer database tilkobling
Skriv inn riktige verdier for __user__, __password__, __db__, etc. i _/helpers/config.php_.

### 3.3 Last inn database skjema
Naviger til _/helpers/_ og skriv inn følgende i en terminal:
`php -f schema.php`
 
