let flag=2;

function controller (x) {
    flag = flag +x;
    slideshow(flag);

}
slideshow(flag);


function slideshow(num) {
    let slides=document.getElementsByClassName('slide');
   

    if(num == slides.length) {
         flag=0;
          num=0;
    }
    if(num < 0) {
        flag = slides.length-1;
        num= slides.length-1;
        }
    for(let y of slides) {
        y.style.display ="none";
    }
    slides[num].style.display="block";
}
//Navbar Js//
var menu_open = document.querySelector('.menu_open');
var menu_close = document.querySelector('.menu_close');
var links = document.querySelector('.navbar .links');

console.log(links.classList)

menu_open.addEventListener('click', function () {

    links.classList.toggle('active');
    console.log(links.classList);

});

menu_close.addEventListener('click', () => {

    links.classList.toggle('active');
    console.log(links.classList);

});
//curd operations//
ClassicEditor.create(document.querySelector("#body"),{
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "bulletedList",
        "numberedList",
        "blockQuote"
    ],
    heading:{
        options: [
            { model: "paragraph", title: "Paragraph", class:"ck-heading_paragraph"},
            {
                model : "heading1",
                view : "h1",
                title : "Heading 1",
                class : "ck-heading_heading1"
            },
            {
                model : "heading2",
                view : "h2",
                title : "Heading 2",
                class : "ck-heading_heading2"
            }
        ]
    }
}).catch(error => {
    console.log(error);
});