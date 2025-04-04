
//Questo script attende che il DOM sia completamente caricato (DOMContentLoaded)
document.addEventListener('DOMContentLoaded', function() {
    const leftCurtain = document.querySelector('.curtain-left');
    const rightCurtain = document.querySelector('.curtain-right');
  
    // Opzione 1: Apri il sipario immediatamente al caricamento (con un piccolo ritardo opzionale)
    //Utilizzo setTimeout per aggiungere le classi di animazione dopo un breve ritardo (per permettere al browser di renderizzare inizialmente lo stato chiuso).
    setTimeout(() => {
      leftCurtain.classList.add('open-left');
      rightCurtain.classList.add('open-right');
    }, 500); // Ritardo di 500ms (mezzo secondo)
  
    
  });