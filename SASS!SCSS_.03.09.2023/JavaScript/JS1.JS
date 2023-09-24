function l(A) {
  console.log(A);
}

//Evenment-------------------------------------------------------
function eventF(A, Event, Func) {
  A.addEventListener(Event, () => {
    Func();
  });
}

// Nav______________________________________________________

// Pub______________________________________________________

// PubClasse______________________________________________________
const PubClasse1 = document.querySelectorAll(".Pub");
const PubParent = document.querySelector(".pubfloue");
PubClasse1.forEach(function (i) {
  const NewPubClasse2 = i
    .querySelector(".Info")
    .querySelector(".TitlePub").textContent;
  i.classList.add("NP-" + NewPubClasse2);
});
//NewFunction
function HoverFloue() {
  PubParent.classList.add("Floue");
}
function OutFloue() {
  PubParent.classList.remove("Floue");
}
PubClasse1.forEach(function (elem) {
  eventF(elem, "mouseover", HoverFloue);
  eventF(elem, "mouseout", OutFloue);
});
