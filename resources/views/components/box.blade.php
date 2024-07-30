
<div>
    <!-- An unexamined life is not worth living. - Socrates -->
    <div class="component-option-box">
        <img class="option-box-image" src={{$source}}>
        <div class="option-box-cover">
            <div class="box-use">USE</div>
        </div>
    </div>
</div>

<style>
    .component-option-box{
        width:140px;
        height:200px;
        position:relative;
       
    }
    .option-box-image{
        width:100%;
        height:100%;
        position:absolute;
      
    }
    .option-box-cover{
        min-width:100%;
        height:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        position:absolute;
        background-color:#e8daef;
        opacity:0.3;
        
    }
    .box-use{
        font-size:25px;
        font-weight:bolder;
        color:black;
    }
    .component-option-box:hover{
        
    }
</style>
<script>
    
   /*
    component_option_box=document.getElementByclass("component-option-box")
    option_box_cover_array=document.getElementByclass("option-box-cover")
    component_option_box.addEventListener('mouseover', function func1(e){
            console.log(option_box_cover_array)
            option_box_cover_array.style.display="none";
    });
    component_option_box.addEventListener('mouseout', function func2(e){
            option_box_cover_array.style.display="flex";
    });
    */
    
   
</script>