let slides = document.querySelectorAll("#slider-wrapper img");//slides.length = 3
let counter = 0;

slides.forEach((slide, index) => {
    slide.style.left = `${index * 100}%`;
});

const slideImage = () => {
    slides.forEach((slide) => {
      slide.style.transform = `translateX(-${counter * 100}%)`;//translateX()平面上水平重新定位元素
    });
  };

  function moveRight() {
    if (counter < slides.length - 1) {
      counter++;
      slideImage();
    } else if (counter === slides.length - 1) {
      counter = 0;
      slideImage();
    }
  }
  
  function moveLeft() {
    if (counter === 0) {
      counter = slides.length - 1;
      slideImage();
    } else {
      counter--;
      slideImage();
    }
  }
  
  $(function () {
    //每3秒执行一次
    let interval = setInterval(() => {
      moveRight();
    }, 3000);//setInterval() 方法可按照指定的周期（以毫秒计）来调用函数或计算表达式.
  
    $("#prev").click(() => {
      moveLeft();
    });
  
    $("#next").click(() => {
      moveRight();
    });
  
    $("#slider-wrapper").mouseover(() => {
      clearInterval(interval);
    });
  
    $("#slider-wrapper").mouseleave(function () {
      interval = setInterval(() => {
        moveRight();
      }, 3000);
    });
  });