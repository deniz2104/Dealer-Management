const testimonials = [
  {
    name: "Marcelitos",
    job: "Thief",
    image: "CiolacuIonMarcel.jfif",
    testimonial:
      "Bought brand new Mercedes AMG G63 after stealing from the old.Perfect condition nappa leather with gold insertions on the cockpit.All my coleagues now want to buy from 'Da cazanu si ti dau altul'",
  },
  {
    name: "Eric",
    job: "Pimp",
    image: "eric-berinde-ispita.jpg",
    testimonial:
      "Stolen my favorite car from the dealership and now I'm rich.Rolls Royce Phtanom 2022 to be exactly.",
  },
  {
    name: "Niku",
    job: "President",
    image: "Nicolae_Ceaușescu.jpg",
    testimonial:
      "Glory to this boys.They sold me a perfect Dacia 1310 to take my lady to have a Big Tasty at Piata Romana.",
  },
  {
    name: "Gygy",
    job: "Pop Star",
    image: "gigel_frone.jfif",
    testimonial:
      "The car was delivered in front of Nuba Mamaia Nord after my concert.Two beautiful ladies were getting ready to hop in.Beautfiul BMW E46,stage 2,turbo replaced having a total capacity of 300hp.Beating all the bombardiers on the Mamaia Boulevard.",
  },
  {
    name: "Base",
    job: "Diplomat",
    image: "basescu.jpeg",
    testimonial:
      "Sold my ship to buy 10 cars to be on the same level with my neighbour Andrew Tate.All the chicks that Andrew Tate has are now in my cars making photos.What a beautiful life because of this amazing dealership.",
  },
];

let i = 0;
let j = testimonials.length;

let testimonial_container = document.getElementById("testimonial-container");
let nextBtn = document.getElementById("next");
let prevBtn = document.getElementById("prev");

nextBtn.addEventListener("click", () => {
  i = (i + 1 + j) % j;
  DisplayTestimonial();
});

prevBtn.addEventListener("click", () => {
  i = (i - 1 + j) % j;
  DisplayTestimonial();
});

let DisplayTestimonial = () => {
  testimonial_container.classList.add("hidden");

  setTimeout(() => {
    testimonial_container.innerHTML = `
    <p>${testimonials[i].testimonial}</p>
    <img src=${testimonials[i].image}>
    <h3>${testimonials[i].name}</h3>
    <h5>${testimonials[i].job}</h5>`;

    testimonial_container.classList.remove("hidden");
  }, 500);
};

window.onload = DisplayTestimonial;
