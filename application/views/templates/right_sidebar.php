<div class="col-md-3 hidden-sm hidden-xs">


    <div class="col-md-12 advt">
    <div class='slider'>
      <div class='slide1'></div>
      <div class='slide2'></div>
      <div class='slide3'></div>
    </div>
    </div>

    <div class="col-md-12 advt">
    <div class='slider'>
      <div class='slide3'></div>
      <div class='slide2'></div>
      <div class='slide1'></div>

    </div>
    </div>


</div>





<style>
.slider {
  max-width: 300px;
  height: 200px;
  margin: 20px auto;
  position: relative;
}
.slide1,.slide2,.slide3,.slide4,.slide5 {
  position: absolute;
  width: 100%;
  height: 100%;
}
.slide1 {
  background: url(http://media.dunkedcdn.com/assets/prod/40946/580x0-9_cropped_1371566801_p17tbs0rrjqdt1u4dnk94fe4b63.jpg)no-repeat center;
      background-size: cover;
    animation:fade 8s infinite;
-webkit-animation:fade 8s infinite;

} 
.slide2 {
  background: url(http://media.dunkedcdn.com/assets/prod/40946/580x0-9_cropped_1371565525_p17tbqpu0d69c21hetd77dh483.jpeg)no-repeat center;
      background-size: cover;
    animation:fade2 8s infinite;
-webkit-animation:fade2 8s infinite;
}
.slide3 {
    background: url(http://media.dunkedcdn.com/assets/prod/40946/580x0-9_cropped_1371564896_p17tbq6n86jdo3ishhta3fv1i3.jpg)no-repeat center;
      background-size: cover;
    animation:fade3 8s infinite;
-webkit-animation:fade3 8s infinite;
}
@keyframes fade
{
  0%   {opacity:1}
  33.333% { opacity: 0}
  66.666% { opacity: 0}
  100% { opacity: 1}
}
@keyframes fade2
{
  0%   {opacity:0}
  33.333% { opacity: 1}
  66.666% { opacity: 0 }
  100% { opacity: 0}
}
@keyframes fade3
{
  0%   {opacity:0}
  33.333% { opacity: 0}
  66.666% { opacity: 1}
  100% { opacity: 0}
}  
</style>