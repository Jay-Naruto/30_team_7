<!DOCTYPE html>
<html lang="en">
  <head>
<?php include 'header.php'?>

    
    <script>
        function showText(toggleText) {
    toggleText.classList.toggle("active");
}
    </script>
    <link rel="stylesheet" href="css/production.css"/>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="css/s.css"/>

<style>
    .card-category-1{
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: space-evenly;
    align-items: center;
    margin-top: 100px;
    flex-wrap:wrap;


}
.basic-card {
  transition: box-shadow .3s;
 
  border-radius:10px;
  border: 1px solid #ccc;
  background: #fff;
  float: left;
  
}
.basic-card:hover {
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
.basic-card{
    background-color: rgba(0, 0, 0,0.9);
    color: white;
    width: 200px ;
    height: max-content;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px 10px;
}
.card-content{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.card-title{
    font-size: 20px;
    margin-top:5px;
}
.card-text{
    font-size: 14px;
    margin-top:5px;

}
.card-link{
    font-size: 12px;
    background-color:white;
    color:black;
    width:100%;
    text-align:center;
    padding:8px 0;
    border-radius:20px;


}
.person-icon{
    width:90px;
    position: relative;
    bottom:50px;
    height:auto;
    border-radius:50%
}
a{
    text-decoration:none;
}
</style>
    <body style="text-align:center">
        <h1>Meet our Experts</h1>
        <h5>Get a premium and ask experts your doubts!</h5>
        <div class="card-category-1">
            {%for i in reading%}

            <div class="basic-card basic-card-aqua">
                <img class="person-icon" src="https://icon-library.com/images/person-image-icon/person-image-icon-17.jpg" alt=""/>                
                <div class="card-content">
                    <span class="card-title">{{i[4]}}</span>
                    <span class="card-text">{{i[3]}}</span>
                    <span class="card-text">
                        <a target="_blank" href='https://www.linkedin.com/in/{{i[1]}}'>
                      {{i[1]}}
                 
                        </a>
                    </span>
                    

                    
                   
                </div>
                 <hr></hr>
                <div class="card-link">
                    <a href="http://localhost/cgs2/premium.php" title="Read Full"><span style="color:black !important">Ask for consultancy</span></a>
               

                </div>
            </div>
          {%endfor%}
           
 </div>
    </body>
    </head>
</html>
