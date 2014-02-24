--requette 1--
select intitule from Epreuve;
--requette 2--
select nom, age, sexe from Etudiant;
--requette 3--
Select * from Manifestation
where dateman>1999-02-12;
--requette 4--
select nbEtudiants from Iut where Iut.adresse = "Belfort";
--requette 5--
SELECT nom, age, sexe 
from Etudiant, Iut 
where Etudiant.noIut=Iut.noIut 
and Iut.adresse="Belfort";
--requette 6--
Select e2.nom
From Etudiant e1, Etudiant e2
where e1.age = e2.age
and e1.nom="toto";
--requette 7--
select count(Contenu.numEpreuve), Manifestation.nomMan 
from Contenu, Manifestation 
where Manifestation.numMan = Contenu.numMan 
Group by Contenu.numMan;
--requette 8--
Select i.nomIut, count(distinct p.noEtudiant) as nbEtudiants 
from Participe p, Etudiant e, Iut i 
where p.noEtudiant = e.noEtudiant 
and i.noIut = e.noIut 
Group by e.noIut;
--requette 9--

SELECT distinct m.nomMan 
from Manifestation m, Participe p, Etudiant e 
where m.numMan = p.numMan 
and p.noEtudiant=e.noEtudiant 
and e.nom='toto';