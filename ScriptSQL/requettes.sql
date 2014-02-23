--requette 1--
select intitule from Epreuve;
--requette 2--
select nom, age, sexe from Etudiant;
--requette 3--
Select * from Manifestation
where dateman>1999-02-12;
--requette 4--
select nbEtudiants from Iut where Iut.adresse = Belfort;
--requette 5--
select * from Etudiant
where etudiant.noIut=Iut.noIut and iut.adresse="Belfort";
--requette 6--
Select e2.nom
From Etudiant e1, Etudiant e2
where e1.age = e2.age
and e1.nom="toto";
--requette 7--
select count(numEpreuve)
from Contenu Group by numMan; 
--requette 8--
Select noIut, count (distinct noEtudiant) as nbEtudiants
from Participe p, Etudiant e
where p.noEtudiant=e.noEtudiant
Group by e.noIut;
--requette 9--

Select distinct Manifestation.nomMan
from Manifestation m, Participe P, Etudiant e
where m.numMan=p.numMan
and p.noEtudiant=e.noEtudiant
and e.nom='toto';
