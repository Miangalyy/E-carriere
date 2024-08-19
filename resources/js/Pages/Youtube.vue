<template>
   <div class="slide-container swiper">
    <div class="slide-content">
        <div class="card-wrapper swiper-wrapper">
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>  
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>         
            <div class="cardee swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>
                    <div class="card-image">
                        <img src="images/profile1.jpg" alt="" class="card-img">
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="name">David Johns</h2>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit
                        </p>
                        <button class="bouttons">View more</button>
                </div>
            </div>                         
        </div>
    </div>
    <div class="swiper-button-next swiper-navBtn ml-4"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
   </div>
</template>
<script>
import AuthLayout from "../Layouts/AuthLayout.vue";
 export default{
    layout: AuthLayout
 }
 
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #EFEFEF;

  }
  .slide-container{
    max-width: 1120px;
    width: 100%;
    padding: 40px 0;
  }
  .cardee{
    width: 320px;
    background: #FFF;
    border-radius: 25px;
  }
  .slide-content{
    margin: 0 40px;
    border-radius: 25px;
    overflow: hidden;
  }
  .overlay{
    position:absolute;
    top: 0;
    left: 0;
    background: #4070F4;
    height: 100%;
    width: 100%;
    border-radius: 25px 25px 0 25px;
  }
  .overlay::before,
  .overlay::after{
    content: '';
    border: none;
    position: absolute;
    width: 40px;
    height: 40px;
    right: 0;
    bottom: -40px;
    background: #4070F4;
  }
  .overlay::after{
    border-radius: 0 25px 0 0;
    background: #fff;
  }
  .image-content{
    row-gap: 5px;
    position: relative;
  }
  .image-content,
  .card-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
  }
  .card-image{
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
  }
  .card-image .card-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #4070F4;
  }
  .name{
    font-size: 18px;
    font-weight: 500;
    color: #333;
  }
  .description{
    font-size: 14px;
    color: #707070;
    text-align: center;
  }
  .bouttons{
    border: none;
    background: #4070F4;
    color: #FFF;
    font-size: 16px;
    padding: 8px 16px;
    margin: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 6px;
  }
  .bouttons:hover{
    background: #265df2;
}
.swiper-navBtn{
    color: #6e93f7;
    transition: color 0.3s ease;
}
.swiper-navBtn:hover{
    color: #4070f4;
}
.swiper-navBtn::before,
.swiper-navBtn::after{
    font-size: 40px;
}
.swiper-button-next{
    right: 0;
}
.swiper-button-prev{
    left: 0;
}
.swiper-pagination-bullet{
    background: #6e93f7;
    opacity: 1;
}
.swiper-pagination-bullet-active{
    background: var(--blue);
}

@media screen and (max-width: 768px){
    .slide-content{
        margin: 0 10px;
    }
    .swiper-navBtn{
        display: none;
    }
}
</style>