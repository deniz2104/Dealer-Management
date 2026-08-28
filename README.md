# Auto Dealer Website Management

## Descriere:

Acest proiect este o aplicație web dedicată gestionării unui dealer auto, care oferă funcționalități precum gestionarea vânzătorilor, clienților, mașinilor și tranzacțiilor. Aplicația permite conectarea utilizatorilor cu diferite roluri (“admin” sau “vânzător”) și facilitează monitorizarea activităților de vânzări.

## Motivația și obiectivele proiectului:

- **Motivație:** Automatizarea procesului de gestiune pentru un dealer auto, reducerea erorilor manuale și crearea unei platforme accesibile pentru utilizatori.
- **Obiective:**
  - Implementarea unei baze de date eficiente pentru gestionarea entităților cheie.
  - Crearea unei interfețe intuitive pentru utilizatorii finali.
  - Optimizarea performanței aplicației pentru gestionarea tranzacțiilor.

## Interfața:

- **Design Responsiv:** Aplicația este optimizată pentru a fi utilizată pe diferite dispozitive.
- **Elemente:**
  - **Formulare dinamică:** Live search pentru nume, prenume și ID.
  - **Tabele:** Afisarea entităților sub formă de tabele, cu design personalizat.
  - **Pop-up Modal:** Liste detaliate ale vânzătorilor și mașinilor disponibile, afișate într-o fereastră modal.

## Implementare:

- **Front-End:** HTML, CSS și JavaScript (jQuery) pentru funcționalități dinamice și design responsiv.
- **Back-End:** PHP pentru procesarea cererilor utilizatorilor și manipularea bazei de date.
- **Baza de Date:** MySQL pentru stocarea informațiilor despre clienți, vânzători, mașini și tranzacții.
- **Funcționalități principale:**
  - Autentificare cu roluri multiple (admin/vânzător).
  - Căutare live pentru validarea numelor, prenume sau ID-urilor.
  - Rapoarte pentru top vânzători și mașini nevândute.

## Bug-uri și probleme întâlnite:

- **Live Search:** Probleme inițiale cu afișarea sugestiilor într-o manieră dinamică.
- **Query-uri SQL:** Dificultăți într-o primă fază cu interogările complexe, mai ales cele cu parametri variabili.
- **Design modal:** Integrarea tabelelor mari într-un modal cu aspect responsiv.
- **Probleme legate de portul MySQL:**
  - Lucrand concomitent intr-un proiect in spring care foloseste baza de date,portul era ocupat de un proces zombie.
  - Am rezolvat acest lucru prin oprirea lui din cmd.

## Viitoare îmbunătățiri:

1. **Funcționalități adiționale:**
   - Adăugarea unui sistem de notificări pentru tranzacții noi.
   - Exportarea rapoartelor în format Excel sau PDF.
2. **Optimizări performanță:**
   - Crearea unor indici suplimentari în baza de date pentru interogări mai rapide.
3. **Securitate:**
   - Integrarea unui sistem de autentificare cu 2 factori (2FA).
4. **UI/UX:**
   - Crearea unui dashboard mai interactiv pentru administratori.
5. **Adaugarea facilitatii unui client de o opera pe site.**
6. **Un notification panel in cadrul adminului unde este notificat de diverse lucruri.**

---
