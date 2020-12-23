Beste lezer

Bij het imorteren van de database kunnen er zich problemen voordoen doordat de maximum toegelaten lengte van de query te lang is om in 1 keer uit te voeren met een import of een sql statement. Geen zorgen, dit kunt u redelijk gemakkelijk oplossen. Volg stap voor stap de instructies en alles zou goed moeten komen! Here we go:

1. Begeef u naar uw xampp directory, ga dan naar mysql en vervolgens naar de bin map. De directory ziet er als volgt uit in mijn geval maar kan verschillen: C:\xampp\mysql\bin
2. Kopieer het sql database bestand in deze map en open vervolgens CMD als administator.
3. Eens dit geopent is, geef je het de command CD gevolgt door de directory van je bin map in xampp in (cd C:\xampp\mysql\bin in mijn geval)
4. Voer dan het volgende commando in: mysql -u root-p habe < processor.sql
Er zal nu om een wachtwoord gevraagd worden waar je gewoon een enter moet zetten en wacht tot het voltooid is (dit zou niet zo lang moeten duren)
5. Kijk nu of de database is geimporteerd in phpmyadmin. Zo ja? Goed zo, dat is alles. Als het niet gelukt is, probeer de stappen opnieuw te volgen.

Veel succes.