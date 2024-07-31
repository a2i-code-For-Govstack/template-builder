@extends('layouts.app')

@section('content')


<script>
    var form= @json($form);

        if ((form.paper_size.split('X')[0])<=(form.paper_size.split('X')[1])){
            height=1000;
            width=580;
            bodyWidth=564;
            bodyHeight=846;
        }
        else{
            height=((780/form.paper_size.split('X')[0])*form.paper_size.split('X')[1]);
            width=600;
        }
    address="url('"+form.background_image+"')";
    tinymce.init({
        selector: '.content',
        content_css: "/css/tinymce.css",
        resize:"both",
        height:height,
        margin:0,
        width:width,
        
        setup: function (editor) { 
            
            editor.on('init', function () {
                editor.getDoc().body.style.backgroundImage =address;
                editor.getDoc().body.style.backgroundColor= form.background_image;
                editor.getDoc().body.style.backgroundSize = "contain";
                editor.getDoc().body.style.backgroundRepeat = "no-repeat"; 
                editor.getDoc().body.style.width= bodyWidth+"px"; 
                editor.getDoc().body.style.height= bodyHeight+"px"; 

                
                setTimeout(applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement),1000);
                unEditabledivs(editor)
                
            });  
            editor.on('dragstart', function (e) {
                e.preventDefault()
            });
            
            editor.on('dragend', function (e) {
                e.preventDefault()
            
            });
            editor.on('NodeChange', function (e) {
                    
                    applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                    
                    tinymce.activeEditor.dom.select('.selected-node').forEach(function(node) {
                    node.classList.remove('selected-node');
                    });
                    selectedNode = editor.selection.getNode();
                    selectedNode.classList.add('selected-node');
                    unEditabledivs(editor)
                    
            });  
            
            editor.on('setContent', function (e) {
                    
                    applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                    unEditabledivs(editor)
            });
            
            editor.on('click', function (e) {
                e.preventDefault()
            });
            editor.on('change', function () {
                //tinymce.triggerSave();
            });
            editor.on('drop', function(event) {
                

                event.preventDefault();
                event.stopPropagation();
                const jsonData= event.dataTransfer.getData('application/json');
                const information= JSON.parse(jsonData);
                const id=information.id
                const classes=information.classes
               
                const rect = editor.getDoc().body.getBoundingClientRect();
                editor.getDoc().body.position="absolute";
                const x = event.clientX ;
                const y = event.clientY;
                if(classes=="text draggable"){
                    if(id=="h1-text"){
                        newElement=editor.dom.create('h1', { class: 'div-resizable-draggable' });
                    }
                    if(id=="h2-text"){
                        newElement=editor.dom.create('h2', { class: 'div-resizable-draggable' });
                    }
                    if(id=="h3-text"){
                        newElement=editor.dom.create('h3', { class: 'div-resizable-draggable' });
                    }
                    if(id=="h4-text"){
                        newElement=editor.dom.create('h4', { class: 'div-resizable-draggable' });
                    }
                    if(id=="h5-text"){
                        newElement=editor.dom.create('h5', { class: 'div-resizable-draggable' });
                    }
                    if(id=="h6-text"){
                        newElement=editor.dom.create('h6', { class: 'div-resizable-draggable' });
                    }
                    if(id=="p-text"){
                        newElement=editor.dom.create('p', { class: 'div-resizable-draggable' });
                    }
                    newElement.innerText="Rewrite this content";
                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;
                    console.log(newElement)
                    editor.getDoc().body.appendChild(newElement);
                }
                if(classes=="line draggable"){
                    const newElement = editor.dom.create('div', { class: 'div-resizable-draggable' });
                    newElement.style.overflow="visible"
                    if (id=="solid-line"){
                        newElement.setAttribute("style","width:100%;height:2px;border:none;border-bottom:2px solid black;");
                    }
                    if (id=="thick-line"){
                        newElement.setAttribute("style","width:100%;border:none;border-top:5px solid black;");
                    }
                    if (id=="dotted-line"){
                        newElement.setAttribute("style","width:100%;border:none;border-top:5px solid black;");
                    }
                    if (id=="dashed-line"){
                        newElement.setAttribute("style","width:100%;border:none;border-top:5px solid black;");
                    }
                    if (id=="double-line"){
                        newElement.setAttribute("style","width:100%;border:none;border-top:5px solid black;");
                    }
                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;
                    console.log(newElement)
                    editor.getDoc().body.appendChild(newElement);
                }
                if(classes=="table draggable"){
                    const newElement = editor.dom.create('table', {
                        class: 'div-resizable-draggable'
                    });
                    
                    const colgroup = editor.dom.create('colGroup');
                    const col1 = editor.dom.create('col');
                    const col2 = editor.dom.create('col');
                    const col3 = editor.dom.create('col');
                    editor.dom.add(newElement,colgroup)
                    editor.dom.add(colgroup,col1)
                    editor.dom.add(colgroup,col2)
                    editor.dom.add(colgroup,col3)
                    // Create and append the tbody and rows
                    const tbody = editor.dom.create('tbody');
                    editor.dom.add(newElement,tbody)
                    const tr1 = editor.dom.create('tr');
                    editor.dom.add(tbody,tr1)
                    const tr2 = editor.dom.create('tr');
                    editor.dom.add(tbody,tr2)
                    const tr3 = editor.dom.create('tr');
                    editor.dom.add(tbody,tr3)
                    const td11 = editor.dom.create('td');
                    const td12 = editor.dom.create('td');
                    const td13 = editor.dom.create('td');
                    const td21 = editor.dom.create('td');
                    const td22 = editor.dom.create('td');
                    const td23 = editor.dom.create('td');
                    const td31 = editor.dom.create('td');
                    const td32 = editor.dom.create('td');
                    const td33 = editor.dom.create('td');
                    editor.dom.add(tr1, td11);
                    editor.dom.add(tr1, td12);
                    editor.dom.add(tr1, td13);
                    editor.dom.add(tr2, td21);
                    editor.dom.add(tr2, td22);
                    editor.dom.add(tr2, td23);
                    editor.dom.add(tr3, td31);
                    editor.dom.add(tr3, td32);
                    editor.dom.add(tr3, td33);
                    if (id=="plain-table"){
                        
                    }
                    if (id=="pink-table"){
                        editor.dom.addClass(newElement, 'pinktable');
                    }
                    if (id=="blue-table"){
                        editor.dom.addClass(newElement, 'bluetable');
                    }
                    if (id=="olive-table"){
                        editor.dom.addClass(newElement, 'olivetable');
                    }
                    if (id=="first-row-pink-table"){
                        editor.dom.addClass(newElement, 'firstrowpinktable');
                    }
                    if (id=="first-row-blue-table"){
                        editor.dom.addClass(newElement, 'firstrowbluetable');
                    }
                    if (id=="first-row-olive-table"){
                        editor.dom.addClass(newElement, 'firstrowolivetable');
                    }
                    if (id=="first-row-first-column-pink-table"){
                        editor.dom.addClass(newElement, 'firstrowfirstcolumnpinktable');
                    }
                    if (id=="first-row-first-column-blue-table"){
                        editor.dom.addClass(newElement, 'firstrowfirstcolumnbluetable');
                    }
                    if (id=="first-row-first-column-olive-table"){
                        editor.dom.addClass(newElement, 'firstrowfirstcolumnolivetable');
                    }
                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;
                    editor.getDoc().body.appendChild(newElement);
                }
                if (classes=="block draggable"){
                    const newElement = editor.dom.create('div', {
                        class: 'div-resizable-draggable'
                    });
                    //newElement.setAttribute("contentEditable","false")
                    if (id=="1:1-blue-block"){
                        newElement.setAttribute("style","background-color:#B3E5FC;width:100px;height:100px;")
                    }
                    if (id=="1:1-grey-block"){
                        newElement.setAttribute("style","background-color:#CFD8DC;width:100px;height:100px;")
                    }
                    if (id=="1:1-yellow-block"){
                        newElement.setAttribute("style","background-color:#FFECB3;width:100px;height:100px;")
                    }
                    if (id=="1:1-green-block"){
                        newElement.setAttribute("style","background-color:#DCEDC8;width:100px;height:100px;")
                    }
                    if (id=="1:1-pink-block"){
                        newElement.setAttribute("style","background-color:#FFCCBC;width:100px;height:100px;")
                    }
                    if (id=="1:1-purple-block"){
                        newElement.setAttribute("style","background-color:#D1C4E9;width:100px;height:100px;")
                    }

                    if (id=="4:5-blue-block"){
                        newElement.setAttribute("style","background-color:#B3E5FC;width:200px;height:250px;")
                    }
                    if (id=="4:5-grey-block"){
                        newElement.setAttribute("style","background-color:#CFD8DC;width:200px;height:250px;")
                    }
                    if (id=="4:5-yellow-block"){
                        newElement.setAttribute("style","background-color:#FFECB3;width:200px;height:250px;")
                    }
                    if (id=="4:5-green-block"){
                        newElement.setAttribute("style","background-color:#DCEDC8;width:200px;height:250px;")
                    }
                    if (id=="4:5-pink-block"){
                        newElement.setAttribute("style","background-color:#FFCCBC;width:200px;height:250px;")
                    }
                    if (id=="4:5-purple-block"){
                        newElement.setAttribute("style","background-color:#D1C4E9;width:200px;height:250px;")
                    }

                    if (id=="9:16-blue-block"){
                        newElement.setAttribute("style","background-color:#B3E5FC;width:90px;height:160px;")
                    }
                    if (id=="9:16-grey-block"){
                        newElement.setAttribute("style","background-color:#CFD8DC;width:90px;height:160px;")
                    }
                    if (id=="9:16-yellow-block"){
                        newElement.setAttribute("style","background-color:#FFECB3;width:90px;height:160px;")
                    }
                    if (id=="9:16-green-block"){
                        newElement.setAttribute("style","background-color:#DCEDC8;width:90px;height:160px;")
                    }
                    if (id=="9:16-pink-block"){
                        newElement.setAttribute("style","background-color:#FFCCBC;width:90px;height:160px;")
                    }
                    if (id=="9:16-purple-block"){
                        newElement.setAttribute("style","background-color:#D1C4E9;width:90px;height:160px;")
                    }
                    
                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;
                    
                    editor.getDoc().body.appendChild(newElement);
                }
                if (classes=="icon draggable" || classes=="image draggable"){
                    t= event.dataTransfer.getData('text/plain');
                    const newElement = editor.dom.create('img', {
                        class: 'div-resizable-draggable'
                    });
                    newElement.setAttribute("src",t)
                    newElement.style.maxWidth="100%";
                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;
                    editor.getDoc().body.appendChild(newElement);
                    
                }
                
                applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                unEditabledivs(editor)
            });
            editor.on('dragover', function(event) {
                event.preventDefault();
            });  
            editor.on('keydown', function (e) {
            
            if (e.keyCode == 13) { 
                e.preventDefault();
                editor.execCommand('InsertLineBreak');
            }
            if (e.keyCode === 32) {  // Space key
                e.preventDefault();  
                editor.insertContent('&nbsp;');
            }
            });
            editor.ui.registry.addButton('deleteSelectedElement', {
                    text: 'Delete',
                    onAction: function () {
                        var selectedNode = editor.selection.getNode();
                        if (selectedNode.tagName=="IMG"){
                            while (selectedNode && (selectedNode.tagName !== "P" )){
                                selectedNode = selectedNode.parentNode;
                            }
                        }
                        if (selectedNode) {
                            selectedNode.remove();
                        }
                    }
            });
            
        },
        plugins: 'noneditable code table lists insertdatetime link textcolor print preview',
        /*
        menubar:'file',*/
        toolbar: 'deleteSelectedElement | undo redo| bold italic underline forecolor backcolor fontselect| alignleft aligncenter alignright alignjustify | bullist numlist | table ',
        insertdatetime_dateformat: '%d-%m-%Y',
        content_style: `html { height:100%; background-color:;}body{height:100%;width:100%;margin:0 !important;line-height: 1;overflow:scroll;position:absolute; }`,
        
        });
        
        function editorfunc(y){
            const tochoose=document.getElementsByClassName("editor-choose-element");
            const closeChoose=document.getElementById("close-choose");
            for(var i=0; i<tochoose.length; i++){
                tochoose[i].style.display="none";
            }
            tochoose[y].style.display="block";
            closeChoose.style.display="flex";
        }
        function closingfunc(){
            const tochoose=document.getElementsByClassName("editor-choose-element");
            const closeChoose=document.getElementById("close-choose");
            for(var i=0; i<tochoose.length; i++){
                tochoose[i].style.display="none";
            }
            closeChoose.style.display="none";
        }
        
        setTimeout(function(){
        const draggable = document.getElementsByClassName("draggable");
        for(var i=0; i<draggable.length;i++){
            draggable[i].addEventListener('dragstart', function(event) {
                const data = {
                    id: event.target.id,
                    classes: event.target.className
                };
                const jsonData = JSON.stringify(data);
                event.dataTransfer.setData('application/json', jsonData)
                if (event.target.className=="image draggable"){
                    event.dataTransfer.setData('text/plain', event.target.src);
                }
                if (event.target.className=="icon draggable"){
                    event.dataTransfer.setData('text/plain', event.target.src);
                }
                dragFromElements=true;
            });
        }
        },1000);
        function unEditabledivs(editor) {
                    const divs = editor.getDoc().body.querySelectorAll('div');
                    
                    divs.forEach(div => {
                        if (div.classList.contains('div-resizable-draggable')) {
                        div.setAttribute("contentEditable","false")
                        }
                    });
                    

        }
        function applyDraggableToDivs(editor,body,frame) {
                    let elements = body.querySelectorAll('.div-resizable-draggable');
                    elements.forEach(element => {
                        makeDraggable(element,editor,body,frame);
                       
                    });
        }
        function makeDraggable(element,editor,body,frame) {
                    
                    
                    
                    let isDragging = false;
                    let startX, startY, initialMouseX, initialMouseY;
                    
                    
                    element.addEventListener('mousedown', function (e) {
                            
                            
                            const rect = element.getBoundingClientRect();
                            startX = rect.left ;
                            startY = rect.top ;
                            initialMouseX = e.clientX;
                            initialMouseY = e.clientY;
                            
                            editor.getDoc().addEventListener('mousemove', onMouseMove);
                            editor.getDoc().addEventListener('mouseup', onMouseUp);
                            
                    });
                    
                    function onMouseMove(e) {
                            
                            
                            const iframeRect = frame.getBoundingClientRect();
                            const dx = e.clientX - initialMouseX;
                            const dy = e.clientY - initialMouseY;

                            const newLeft = startX + dx;
                            const newTop = startY + dy;

                            
                            const maxLeft = iframeRect.width - element.offsetWidth;
                            const maxTop = iframeRect.height - element.offsetHeight;

                            
                            element.style.left = Math.min(Math.max(newLeft, 0), maxLeft) + 'px';
                            element.style.top = Math.min(Math.max(newTop, 0), maxTop) + 'px';
                        
                    }


                    function onMouseUp(e) {
                            
                            e.stopPropagation();
                 
                            element.classList.add('selected-node')
                            isDragging = false;
                            
                            editor.getDoc().removeEventListener('mousemove', onMouseMove);
                            editor.getDoc().removeEventListener('mouseup', onMouseUp);
                            
                    }
                }
        
                
</script>
<style>
    textarea{
        width:100%;
    }
    #editor-main{
        display:flex;
        width:fit-content;
        margin-top:20px;
        height:100vh;
        position:sticky;
        top:0;
    }
    .card{
        width:fit-content;
        height:fit-content;
        margin:auto;
        margin-top:30px;
    }
    .card-header{
        background-color:#bb8fce ;
        height:40px;
    }
    .card-body{
        width:fit-content;
        height:fit-content;
        padding:40px;
        background-color:#d7bde2;
    }
    #template-place{
        margin:auto;
       
    }
    #editor-option-block{
        height:100%;
        width:100px;
        padding:15px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        border-radius: 0 20px  20px 0;
        color:black;
        background-color:#C8E9FF ;
        box-shadow:0px 0px 10px 10px #CFD8DC ;
        z-index:1;
        
    }
    .editor-block{
        display:flex;
        width:80px;
        height:80px;
        margin:15px;
        align-items:center;
        justify-content:center;
        flex-direction:column;
    }
    .editor-options{
        width:50px;
        height:50px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:25px;
        border-radius:10px;
        box-shadow:2px 2px 2px 2px black;
        background-color:#ECF6FD;
    }
    .editor-choose-element{
        width:400px;
        height:100%;
        background-color:#ECF6FD ;
        display:none;
        box-shadow:5px 5px 10px 10px #CFD8DC ;
        color:black;
        overflow-y:scroll;
        scrollbar-width: thin;
        scrollbar-color: grey white;
    }
    #close-choose{
        width:25px;
        height:25px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        background-color: #ECF6FD;
        border-radius:50%;
        display:none;
        border:2px solid grey;
        margin: 0 0 0 10px;
        color:grey;
    }
    .written-option{
        margin:5px 0 5px 0;
    }
    .line hr{
        color:white;
        width: 100px;
        opacity:1;
    }
    .editor-choose-option{
        width:100%;
        display:flex;
        overflow-x:scroll;
        background-color:white;
        scrollbar-width: thin;
        scrollbar-color: grey #e5e8e8 ;
        
    }
    .editor-heading{
        font-size:22px;
        font-weight:bolder;
    }
    .editor-choose-element-inner{
        margin:20px;
        padding:20px;
        /*border:2px solid black;*/
        border-radius:20px;
        background-color:#C8E9FF;
    }
    .editor-choose-option::-webkit-scrollbar {
            
    }
    .draggable{
        border:none !important;
        background-color:#ECF6FD;
        border:2px solid black;
    }
    .line{
        min-width:40%;
        margin:5%;
        height:50px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
    }
    .table{
        height:120px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
    }
    .block{
        height:80px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
    }
    .icon{
        height:100px;
        min-width:40%;
        margin:5%;
        padding:20px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
    }
    .image{
        height:150px;
        min-width:90%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
    }
    
    .tox{
        z-index:0 !important;
    }
    .text{
        height:40px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        
    }
     
    @media(max-width:700px){
        .tox-tinymce{
            width:100% !important;
            height:600px !important;
        }
    }
    @media(max-width:1000px){
        #editor-main{
            flex-direction:column-reverse;
            width:100%;
            position:fixed;
            bottom:0;
            z-index:5;
            margin:0;
        }
        #editor-option-block{
            width:100%;
            height:100px;
            flex-direction:row;
            border-radius:20px 20px 0 0;
            
        }
        .editor-block{
            margin:0;
        }
        .editor-choose-element{
            width:100%;
            height:400px;
        }
        .card{
            width:100% !important;
            
        }
        #close-choose{
            margin:5px 0 5px 0;
        }
        
    }
</style>

<div style="display:flex;">
<div id="editor-main">
<div id="editor-option-block">
    <div class="editor-block" onClick="editorfunc(0)">
    <div class="editor-options"><i class="fa-solid fa-newspaper"></i></div>
    <div class="written-option">Templates</div>
    </div>
    <div class="editor-block" onClick="editorfunc(1)">
    <div class="editor-options"><i class="fa-brands fa-elementor"></i></div>
    <div class="written-option">Elements</div>
    </div>
    <div class="editor-block" onClick="editorfunc(2)">
    <div class="editor-options"><i class="fa-solid fa-film"></i></div>
    <div class="written-option">Uploads</div>
    </div>
    <div class="editor-block" onClick="editorfunc(3)">
    <div class="editor-options"><i class="fa-brands fa-elementor"></i></div>
    <div class="written-option">More</div>
    </div>
</div>
<div class="editor-choose-element">

</div>
<div class="editor-choose-element">
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Text</div>
    <div id="texts" class="editor-choose-option">
        <div id="h1-text"class="text draggable" draggable="true"><h1>H1</h1></div>
        <div id="h2-text"class="text draggable" draggable="true"><h2>H2</h2></div>
        <div id="h3-text"class="text draggable" draggable="true"><h3>H3</h3></div>
        <div id="h4-text"class="text draggable" draggable="true"><h4>H4</h4></div>
        <div id="h5-text"class="text draggable" draggable="true"><h5>H5</h5></div>
        <div id="h6-text"class="text draggable" draggable="true"><h6>H6</h6></div>
        <div id="p-text"class="text draggable" draggable="true">Paragraph</div>
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Lines</div>
    <div id="lines" class="editor-choose-option">
        <div id="solid-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:2px solid black;"></div>
        <div id="thick-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px solid black;"></div>
        <div id="dotted-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px dotted black;"></div>
        <div id="dashed-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px dashed black;"></div>
        <div id="double-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px double black;"></div>
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Tables</div>
    <div id="tables" class="editor-choose-option">
        <div id="plain-table"class="table draggable" draggable="true"></div>
        <div id="pink-table"class="table draggable" draggable="true"></div>
        <div id="blue-table"class="table draggable" draggable="true"></div>
        <div id="olive-table"class="table draggable" draggable="true"></div>
        <div id="first-row-pink-table"class="table draggable" draggable="true"></div>
        <div id="first-row-blue-table"class="table draggable" draggable="true"></div>
        <div id="first-row-olive-table"class="table draggable" draggable="true"></div>
        <div id="first-row-first-column-pink-table"class="table draggable" draggable="true"></div>
        <div id="first-row-first-column-blue-table"class="table draggable" draggable="true"></div>
        <div id="first-row-first-column-olive-table"class="table draggable" draggable="true"></div>
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Icons</div>
    <div id="icons" class="editor-choose-option">
        <img id="info-icon"class="icon draggable" draggable="true"src="{{asset('/img/info.png')}}">
        <img id="note-icon"class="icon draggable" draggable="true"src="{{asset('/img/message.png')}}">
        <img id="success-icon"class="icon draggable" draggable="true"src="{{asset('/img/success.png')}}">
        <img id="warning-icon"class="icon draggable" draggable="true"src="{{asset('/img/warning.png')}}">
        <img id="error-icon"class="icon draggable" draggable="true"src="{{asset('/img/error.png')}}">
        <img id="quote-icon"class="icon draggable" draggable="true"src="{{asset('/img/quote.png')}}">
    </div>
    </div>
    
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Blocks</div>
    <div id="blocks" class="editor-choose-option">
        <div id="1:1-blue-block"class="block draggable" draggable="true" style="background-color:#B3E5FC;">1:1</div>
        <div id="1:1-grey-block"class="block draggable" draggable="true" style="background-color:#CFD8DC;">1:1</div>
        <div id="1:1-yellow-block"class="block draggable" draggable="true" style="background-color:#FFECB3;">1:1</div>
        <div id="1:1-green-block"class="block draggable" draggable="true" style="background-color:#DCEDC8;">1:1</div>
        <div id="1:1-pink-block"class="block draggable" draggable="true" style="background-color:#FFCCBC;">1:1</div>
        <div id="1:1-purple-block"class="block draggable" draggable="true" style="background-color:#D1C4E9;">1:1</div>

        <div id="4:5-blue-block"class="block draggable" draggable="true" style="background-color:#B3E5FC;">4:5</div>
        <div id="4:5-grey-block"class="block draggable" draggable="true" style="background-color:#CFD8DC;">4:5</div>
        <div id="4:5-yellow-block"class="block draggable" draggable="true" style="background-color:#FFECB3;">4:5</div>
        <div id="4:5-green-block"class="block draggable" draggable="true" style="background-color:#DCEDC8;">4:5</div>
        <div id="4:5-pink-block"class="block draggable" draggable="true" style="background-color:#FFCCBC;">4:5</div>
        <div id="4:5-purple-block"class="block draggable" draggable="true" style="background-color:#D1C4E9;">4:5</div>

        <div id="9:16-blue-block"class="block draggable" draggable="true" style="background-color:#B3E5FC;">9:16</div>
        <div id="9:16-grey-block"class="block draggable" draggable="true" style="background-color:#CFD8DC;">9:16</div>
        <div id="9:16-yellow-block"class="block draggable" draggable="true" style="background-color:#FFECB3;">9:16</div>
        <div id="9:16-green-block"class="block draggable" draggable="true" style="background-color:#DCEDC8;">9:16</div>
        <div id="9:16-pink-block"class="block draggable" draggable="true" style="background-color:#FFCCBC;">9:16</div>
        <div id="9:16-purple-block"class="block draggable" draggable="true" style="background-color:#D1C4E9;">9:16</div>

    </div>
    </div>
    @php
    $imageArray=[];
    for ($i = 0; $i < 50; $i++) {
        $imageURL=[$i+1,"/img/select-image".strval($i+1).".jpg"];
        array_push($imageArray, $imageURL);
    }
    @endphp
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Images</div>
    <div id="images" class="editor-choose-option">
    @foreach($imageArray as $image)
        <img id="{{$image[0]}}"class="image draggable" draggable="true" src="{{asset($image[1])}}">
    @endforeach
    </div>
    </div>
</div>
<div class="editor-choose-element">
<div id="upload-image" class="draggable"draggable="true">upload image</div>
</div>
<div class="editor-choose-element">

</div>
<div id="close-choose" onClick="closingfunc()"><i class="fa-solid fa-xmark"></i></div>
</div>




<div id="template-place">
<div class="card">
    <div class="card-header">{{ $form->title }}</div>
    <div class="card-body">
        <form id="form"  method="GET"  action="{{ route('export-pdf') }}">
        @csrf
            <textarea class="content " name="content"id="editor-div">
            {{--<div  style="background-color:#FFCCBC;" class="block-div"><img class="block-img"src="{{asset('/img/error.png')}}"></div><div class="block-content"><div class="block-title">Error</div><div>Write your content here.</div></div></div>
            <div></div>
            <table class="firstrowfirstcolumnolivetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>
            <img src="{{asset('/img/select-image1.jpg')}}">
            --}}
            @if($isContent==true)
                
            {!!$form->content!!}
            @else
            
            @endif
            
            
            {{--
            <div style="background-color:blue;width:200px;height:200px;"><div>aditi</div><div>vijay</div></div>
            <div class="div-resizable div-resizable-draggable"style="border:2px solid black;">aditi </div>
            
            <img class="div-resizable-draggable"style=""src="{{asset('/img/select-image4.jpg')}}">
            <p  class="div-resizable-draggable">aditi</p>
            --}}
            </textarea>
            <button type="submit" class="btn btn-success btn-sm float-end">Download PDF</button>
            </form>
        </div>
    </div>
</div>

@endsection