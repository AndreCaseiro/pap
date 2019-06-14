<!DOCTYPE html>
<html>

<head>
    <title>Bem vindo a Dara International</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
#isItLoaded {
  display: none;
}

#loading {
  z-index: 10;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 90vh;
}
    </style>




</head>


<body>
    
    
   
<div id="content">
<div id="loading"></div>
      <div id="isItLoaded"></div>
    </div>

    
  <script>  
     $(window).load(function() {
      console.log("talking");

fetch('my_fetch_url') {
          if (response.status != 200) {
            window.alert("oopsie daisy, you done messed up!");
            return;
          }

response.json().then(function(data) {
            let api = data;
            let isItLoaded = document.getElementById('isItLoaded');
            isItLoaded.value = api[0].book_title;
    
    
    $(document).ready(function() {

setTimeout(function(){
        let loading = document.getElementById('loading').value;
        console.log(loading);
        let content = document.getElementById('isItLoaded');
        if (isItLoaded == undefined) {
          let newDiv = `
          <div class="letter">l</div>
          `;

          loading.innerHTML = newDiv;
          loading.className = 'displayIt';
        }
        else if (isItLoaded !== undefined) {
          loading.innerHTML = "";
          loading.className = 'noDisplay';
        }
      },10);
})
    
    
    $(document).ready(function() {

setTimeout(function(){
        let loading = document.getElementById('loading').value;
        console.log(loading);
        let content = document.getElementById('isItLoaded');
        if (isItLoaded == undefined) {
          let newDiv = `
          <div class="letter">l</div>
          `;

loading.innerHTML = newDiv;
          loading.className = 'displayIt';
        }
        else if (isItLoaded !== undefined) {
          loading.innerHTML = "";
          loading.className = 'noDisplay';
        }
      },10);

setTimeout(function(){
        let loading = document.getElementById('loading').value;
        console.log(loading);
        let content = document.getElementById('isItLoaded');
        if (isItLoaded == undefined) {
          let newDiv = `
          <div class="letter">o</div>
          `;

loading.innerHTML = newDiv;
          loading.className = 'displayIt';
        }
        else if (isItLoaded !== undefined) {
          loading.innerHTML = "";
          loading.className = 'noDisplay';
        }
      },300);
})
    
    
    .letter {
color: #1691BA;
font-size: 45px;
font-family: 'Gloria Hallelujah', cursive;
font-weight: bold;
height: 50px;
text-shadow: rgb(7, 13, 15) 2px 0px 0px, rgb(7, 13, 15) 1.75517px 0.958851px 0px, rgb(7, 13, 15) 1.0806px 1.68294px 0px, rgb(7, 13, 15) 0.141474px 1.99499px 0px, rgb(7, 13, 15) -0.832294px 1.81859px 0px, rgb(7, 13, 15) -1.60229px 1.19694px 0px, rgb(7, 13, 15) -1.97998px 0.28224px 0px, rgb(7, 13, 15) -1.87291px -0.701566px 0px, rgb(7, 13, 15) -1.30729px -1.5136px 0px, rgb(7, 13, 15) -0.421592px -1.95506px 0px, rgb(7, 13, 15) 0.567324px -1.91785px 0px, rgb(7, 13, 15) 1.41734px -1.41108px 0px, rgb(7, 13, 15) 1.92034px -0.558831px 0px;
animation: boing .5s ease-in-out infinite alternate;
    -webkit-animation: boing .5s ease-in-out infinite alternate;
}

@keyframes boing {
    0% {
        transform: scale(1.0);
        transition-timing-function: cubic-bezier(0.64, 0.57, 0.67, 1.53);
    }
    100% {
        transform: scale(1.15);
        transition-timing-function: cubic-bezier(0.64, 0.57, 0.67, 1.53);
    }
}
    
    </script>
</body>

</html>
