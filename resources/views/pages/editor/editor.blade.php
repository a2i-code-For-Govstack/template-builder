@extends('layouts.app')

@section('content')


<script>
    
    var form= @json($form);
    
        if (form.page_type=="vertical"){
            height=980;
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
                editor.getDoc().body.style.backgroundRepeat= "no-repeat";
                
                editor.getDoc().body.style.width= bodyWidth+"px"; 
                editor.getDoc().body.style.height= bodyHeight+"px"; 

                
                setTimeout(applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement),1000);
                
                
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
                    
                    if (selectedNode.querySelector("img") !==null){
                        editor.selection.select(selectedNode.querySelector("img"));
                    }
                    selectedNode.classList.add('selected-node');
                    
                    
            });  
            
            editor.on('setContent', function (e) {
                    
                    applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                   
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

                if (classes=="templateV draggable" || classes=="templateH draggable"){
                    
                    window.location.href = `/form/form-any/${id}`;
                }
                if (classes=="backgroundV draggable" || classes=="backgroundH draggable"){
                    
                    window.location.href = `/form/form-any/background-only/${id}`;
                }
                if(classes=="blankH draggable" || classes=="blankV draggable"){
                    window.location.href = `/form/form-any/background-only/${id}`;
                }

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
                
            });
            editor.on('dragover', function(event) {
                event.preventDefault();
            });  
            editor.on('keydown', function (e) {
                //editor.selection.getNode().tagName=="IMG"
                node=editor.selection.getNode()
                if( node.tagName=="IMG"|| (!node.classList.contains("div-resizable-draggable")&& node.tagName=="P") ||(node.tagName=="BODY")){
                    e.preventDefault()
                }
                else if (e.keyCode == 13) { 
                    e.preventDefault();
                    editor.execCommand('InsertLineBreak');
                }
                else if (e.keyCode === 32) {  // Space key
                    e.preventDefault();  
                    editor.insertContent('&nbsp;');
                }
                else{

                }
            });
            editor.on('mousedown',function(e){
                e.preventDefault()
                //e.stopPropagation();
                let x = event.clientX;
                let y = event.clientY;

                
                let range = editor.selection.dom.createRng();
                let caretPosition = editor.getDoc().caretRangeFromPoint(x, y);
                
                if(caretPosition) {
                range.setStart(caretPosition.startContainer, caretPosition.startOffset);
                range.setEnd(caretPosition.startContainer, caretPosition.startOffset);
                editor.selection.setRng(range);
                } 
                editor.focus();
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
                        if (selectedNode && selectedNode.tagName!=="BODY") {
                            selectedNode.remove();
                        }
                    }
            });
            
        },
        plugins: 'noneditable code table lists insertdatetime link textcolor print preview textshadow',
        
        menubar:'file insert format textshadow',
        
        toolbar: 'deleteSelectedElement textshadow | undo redo| bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist ',
        
        insertdatetime_dateformat: '%d-%m-%Y',
        content_style: `html { height:100%; overflow:scroll;}body{height:100%;width:100%;margin:0 !important;line-height: 1;position:absolute; }`,
        
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
                            
                            editor.getDoc().addEventListener('mousemove', on_MouseMove);
                            editor.getDoc().addEventListener('mouseup', on_MouseUp);
                            
                    });
                    
                    function on_MouseMove(e) {
                            
                            
                            
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


                    function on_MouseUp(e) {
                            
                            
                            e.stopPropagation();
                 
                            isDragging = false;
                            
                            editor.getDoc().removeEventListener('mousemove', on_MouseMove);
                            editor.getDoc().removeEventListener('mouseup', on_MouseUp);
                            
                    }
                }
        async function downloadpng() {
                    

                    try {
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY: -window.scrollY
                        });
                        // Convert the canvas to an image data URL
                        let imgData = canvas.toDataURL("image/png");
                        

                        // Create a link element to trigger the download
                        const link = document.createElement('a');
                        link.href = imgData;
                        link.download = `template.png`;
                        link.click();
                    } catch (err) {
                        console.error("Error:", err);
                    }
                }
        async function downloadjpg() {
                    

                    try {
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY: -window.scrollY
                        });

                        

                        // Convert the canvas to an image data URL
                        let imgData = canvas.toDataURL("image/jpg");
                        

                        // Create a link element to trigger the download
                        const link = document.createElement('a');
                        link.href = imgData;
                        link.download = `template.jpg`;
                        link.click();
                    } catch (err) {
                        console.error("Error:", err);
                    }
                }
        async function downloadpdf() {
                    

                    try {
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY: -window.scrollY
                        });

                        

                        // Convert the canvas to an image data URL
                        let imgData = canvas.toDataURL("image/jpg");
                        const pdf = new jsPDF('p', 'mm', 'a4');
                        const imgWidth = 210;
                        const imgHeight = canvas.height * imgWidth / canvas.width;
                        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                        pdf.save('template.pdf');
                    } catch (err) {
                        console.error("Error:", err);
                    }
                }
                document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('capturepng').addEventListener('click', async () => {
                    await downloadpng();
                });
                document.getElementById('capturejpg').addEventListener('click', async () => {
                    await downloadjpg();
                });
                document.getElementById('capturepdf').addEventListener('click', async () => {
                    await downloadpdf();
                });
                });
 
</script>

<style>
    
    .content{
        
    }
    textarea{
        
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
        margin-bottom:30px;
    }
    .card-header{
        background-color:#4caf50;
        height:40px;
    }
    .card-body{
        width:fit-content;
        height:fit-content;
        padding:40px;
        background-color:#aed581;
    }
    #template-place{
        margin:auto;
       
    }
    #editor-option-block{
        height:97%;
        width:100px;
        padding:15px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        border-radius: 0 20px  20px 0;
        color:black;
        background-color: #aed581 ;
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
        background-color:white;
    }
    .editor-choose-element{
        width:400px;
        height:97%;
        background-color:white;
        display:none;
        color:black;
        overflow-y:scroll;
        scrollbar-width: thin;
        scrollbar-color: #4caf50 #aed581 ;
        border: 5px solid #4caf50;
        border-left:none;
    }
    #close-choose{
        width:25px;
        height:25px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        background-color: #4caf50;
        border-radius:50%;
        display:none;
        border:2px solid black;
        margin: 0 0 0 10px;
        color:black;
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
        scrollbar-color:  #aed581 white ;
        border:2px solid #aed581;
    }
    .editor-heading{
        font-size:22px;
        font-weight:bolder;
    }
    .editor-choose-element-inner{
        margin:20px;
        padding:20px;
        border:2px solid  #4caf50;
        box-shadow:5px 5px 5px #aed581;
        border-radius:20px;
        background-color:white;

    }
    .editor-choose-option::-webkit-scrollbar-track{
        
    }
    .draggable{
        box-shadow:5px 5px 5px  #aed581;
        background-color:white;
        border:2px solid #aed581;
    }
    
    .line{
        min-width:40%;
        margin:5%;
        height:50px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        
    }
    .table{
        height:120px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        
    }
    .block{
        height:80px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        
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
        
    }
    .image{
        height:150px;
        min-width:90%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        
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
    .templateV{
        height:170px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    .templateH{
        height:80px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    .backgroundH{
        height:80px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    .backgroundV{
        height:170px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    .blankV{
        height:170px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    .blankH{
        height:80px;
        min-width:40%;
        margin:5%;
        border-radius:10px;
    }
    @media(max-width:700px){
        .tox-tinymce{
            width:100% !important;
            height:500px !important;
            
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

<div style="display:flex;background-color: ;">
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
    <div class="written-option">Help</div>
    </div>
</div>
<div class="editor-choose-element">
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Blank Pages(vertical)</div>
    <div id="blanksV" class="editor-choose-option">
    @foreach ($forms as $template)
        @if($template->page_type=="vertical" && strpos($template->background_image, '#')=== 0)
            <div id="{{$template->sid}}" draggable="true" class="backgroundV draggable" style="background-color:{{$template->background_image}};" ></div>
        @endif
    @endforeach
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Blank Pages(horizontal)</div>
    <div id="blanksH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal" && strpos($template->background_image, '#')=== 0)
            <div id="{{$template->sid}}" draggable="true" class="backgroundH draggable" style="background-color:{{$template->background_image}};"></div>
        @endif
        @endforeach
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Back Images(vertical)</div>
    <div id="backgroundsV" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="vertical" && strpos($template->background_image, '#')=== false)
            <img id="{{$template->sid}}" draggable="true" class="backgroundV draggable" src="{{ asset($template->background_image)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">back Images(horizontal)</div>
    <div id="backgroundsH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal" && strpos($template->background_image, '#')=== false)
            <img id="{{$template->sid}}" draggable="true" class="backgroundH draggable" src="{{ asset($template->background_image)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">Templates(vertical)</div>
    <div id="templatesV" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="vertical")
            <img id="{{$template->sid}}"draggable="true" class="templateV draggable" src="{{ asset($template->template_type)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">Templates(horizontal)</div>
    <div id="templatesH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal")
            <img id="{{$template->sid}}"draggable="true" class="templateH draggable" src="{{ asset($template->template_type)}}">
        @endif
        @endforeach
    </div>
    </div>
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
        <div id="solid-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:2px solid black;background-color:#aed581;"></div>
        <div id="thick-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px solid black;background-color:#aed581;"></div>
        <div id="dotted-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px dotted black;background-color:#aed581;"></div>
        <div id="dashed-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px dashed black;background-color:#aed581;"></div>
        <div id="double-line"class="line draggable" draggable="true"><hr style="border:none;border-bottom:5px double black;background-color:#aed581;"></div>
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
        <form id="form">
        @csrf
            <textarea class="content " name="content"id="editor-div">
            {{--<div  style="background-color:#FFCCBC;" class="block-div"><img class="block-img"src="{{asset('/img/error.png')}}"></div><div class="block-content"><div class="block-title">Error</div><div>Write your content here.</div></div></div>
            <div></div>
            <table class="firstrowfirstcolumnolivetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>
            <img src="{{asset('/img/select-image1.jpg')}}">
            method="GET"  action="{{ route('export-pdf') }}"
            --}}
            @if($isContent==true)
            
            {!!$form->content!!}
            @else
            <h1 class="div-resizable-draggable" style="position:absolute;top:200px;left:80px;">Start creating your template</h1>
            @endif
            
            {{--
            <div style="background-color:blue;width:200px;height:200px;"><div>aditi</div><div>vijay</div></div>
            <div class="div-resizable div-resizable-draggable"style="border:2px solid black;">aditi </div>
            
            <img class="div-resizable-draggable"style=""src="{{asset('/img/select-image4.jpg')}}">
            <p  class="div-resizable-draggable">aditi</p>
            --}}
            </textarea>
            <button  type="button" id="capturepng" class="btn btn-success btn-sm float-end">Download PNG</button>
            <button  type="button" id="capturejpg" class="btn btn-success btn-sm float-end">Download JPG</button>
            <button  type="button" id="capturepdf" class="btn btn-success btn-sm float-end">Download PDF</button>
            </form>
        </div>
    </div>
</div>
{{--
    node change - always select image and not its parent p 
    keydown- when image is choosen keys stopped working and also if node doesn't has class div-resizable-draggable and is p and also if body is choosen
    mousedown-cutomized because its dragging the image was stoping the resizable option of table 
    (to make elements draggable, used mousedown, mousemove and mouse up)
    --blank page will have a h1 to not have a by default p(we could have p with class div-resizable-draggable but then all p generated itself would have class div-resizable-draggable)
--}}
@endsection


















