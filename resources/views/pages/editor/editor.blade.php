@extends('layouts.app')

@section('content')


<script>
    
    var form= @json($form);
    
        if (form.page_type=="vertical"){
            height=900;
            width=564;
            bodyWidth=564;
            bodyHeight=846;
        }
        else{
            height=500;
            width=600;
            bodyWidth=600;
            bodyHeight=400;
        }
        address="url('"+form.background_image+"')";
    
    tinymce.init({
        selector: '.content',
        content_css: [
            "/css/tinymce.css",
            "/assets/css/bangali-fonts.css",
            'https://fonts.googleapis.com/css?family=Roboto|Open+Sans|Lato&display=swap',
            'https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;700&display=swap'
        ],
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
                    const computedStyle = window.getComputedStyle(selectedNode);
                    const button=editor.getContainer().getElementsByClassName('tox-tbtn');
                    const propertyValue1= computedStyle.getPropertyValue('font-weight');
                    const propertyValue2 = computedStyle.getPropertyValue('font-style');
                    const propertyValue3 = computedStyle.getPropertyValue('text-decoration');
                    const propertyValue4 = computedStyle.getPropertyValue('text-shadow');
                    if (propertyValue1>400){
                            
                            button[2].classList.add('back-color');
                    }
                    else{
                            
                            button[2].classList.remove('back-color');
                    }
                    if (propertyValue2=="italic"){
                            
                            button[3].classList.add('back-color');
                    }
                    else{
                            
                            button[3].classList.remove('back-color');
                    }
                    if (propertyValue3=="underline solid rgb(0, 0, 0)"){
                            
                            button[4].classList.add('back-color');
                    }
                    else{
                            
                            button[4].classList.remove('back-color');
                    }
                    if (propertyValue4=="none"){
                            
                            button[5].classList.remove('back-color');
                    }
                    else{
                            
                            button[5].classList.add('back-color');
                    }
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

                if (classes=="templateV draggable vertical" || classes=="templateH draggable horizontal"){
                    
                    window.location.href = `/form/form-any/${id}`;
                }
                if (classes=="backgroundV draggable vertical" || classes=="backgroundH draggable horizontal"){
                    
                    window.location.href = `/form/form-any/background-only/${id}`;
                }
                if(classes=="blankH draggable horizontal" || classes=="blankV draggable vertical"){
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
                    newElement.contentEditable="false";
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
                
                if (classes=="icon draggable" || classes=="image draggable" || classes=="upload draggable" || classes=="sign draggable"){
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
                    text: 'Del',
                    //icon: 'fa-solid fa-trash',
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
            editor.ui.registry.addButton('BoldLetters', {
                    text: 'B',
                    //icon: 'fa-solid fa-trash',
                    onAction: function () {
                        const element = editor.selection.getNode();
                        const button = editor.getContainer().getElementsByClassName('tox-tbtn');
                        const computedStyle = window.getComputedStyle(element);
                        const propertyValue = computedStyle.getPropertyValue('font-weight');
                        
                        if (propertyValue>400){
                            element.style.fontWeight="400";
                            button[2].classList.remove('back-color');
                        }
                        else{
                            element.style.fontWeight="700";
                            button[2].classList.add('back-color');
                        }
                        console.log(propertyValue)
                    }
            });     
            editor.ui.registry.addButton('ItalicLetters', {
                    text: 'I',
                    //icon: 'fa-solid fa-trash',
                    onAction: function () {
                        const element = editor.selection.getNode();
                        const button = editor.getContainer().getElementsByClassName('tox-tbtn');
                        const computedStyle = window.getComputedStyle(element);
                        const propertyValue = computedStyle.getPropertyValue('font-style');
                        
                        if (propertyValue=="italic"){
                            element.style.fontStyle="normal";
                            button[3].classList.remove('back-color');
                        }
                        else{
                            element.style.fontStyle="italic";
                            button[3].classList.add('back-color');
                        }
                        console.log(propertyValue)
                    }
            });      
            editor.ui.registry.addButton('UnderlinedLetters', {
                    text: 'U',
                    //icon: 'fa-solid fa-trash',
                    onAction: function () {
                        const element = editor.selection.getNode();
                        const button = editor.getContainer().getElementsByClassName('tox-tbtn');
                        const computedStyle = window.getComputedStyle(element);
                        const propertyValue = computedStyle.getPropertyValue('text-decoration');
                        
                        if (propertyValue=="underline solid rgb(0, 0, 0)"){
                            element.style.textDecoration="none solid rgb(0,0,0)";
                            button[4].classList.remove('back-color');
                        }
                        else{
                            element.style.textDecoration="underline solid rgb(0, 0, 0)";
                            button[4].classList.add('back-color');
                        }
                        console.log(propertyValue)
                    }
            });     
            editor.ui.registry.addButton('ShadowLetters', {
                    text: 'S',
                    //icon: 'fa-solid fa-trash',
                    onAction: function () {
                        const element = editor.selection.getNode();
                        const button = editor.getContainer().getElementsByClassName('tox-tbtn');
                        const computedStyle = window.getComputedStyle(element);
                        const propertyValue = computedStyle.getPropertyValue('text-shadow');
                        console.log(button)
                        
                            
                        
                        if (propertyValue=="none"){
                            element.style.textShadow="3px 3px 0px grey";
                            button[5].classList.add('back-color');
                        }
                        else{
                            element.style.textShadow="none";
                            button[5].classList.remove('back-color');
                        }
                        
                    }
            });                        
        },
        
        plugins: ' advlist noneditable code table lists insertdatetime link textcolor print preview textshadow',
        
        menubar:'file insert format textshadow',
        
        toolbar: 'deleteSelectedElement fontfamily BoldLetters ItalicLetters UnderlinedLetters ShadowLetters forecolor backcolor | alignleft aligncenter alignright alignjustify' ,
        
        insertdatetime_dateformat: '%d-%m-%Y',
        font_family_formats: 'Arial=arial,helvetica,sans-serif; Times New Roman=times new roman,times; Courier New=courier new,courier; Open Sans=open sans,sans-serif; Roboto=roboto,sans-serif; Lato=lato,sans-serif;'+ ' Noto Serif Bengali=Noto Serif Bengali,sans-serif;',
        content_style: `html { height:100%;}body::-webkit-scrollbar{ display: none;}body{height:100%;width:100%;margin:0 !important;overflow:scroll;line-height: 1.2;position:absolute; }`,
        });
        
        function editorfunc(y){
            const tochoose=document.getElementsByClassName("editor-choose-element");
            const closeChoose=document.getElementById("close-choose");
            for(var i=0; i<tochoose.length; i++){
                tochoose[i].style.display="none";
            }
            tochoose[y].style.display="block";
            closeChoose.style.display="flex";
            if(window.innerWidth>1000 && window.innerWidth<1050){
                
                closeChoose.style.left="330px";
                
            }
            if(window.innerWidth<1000 && window.innerWidth>400){
                offsetleft=tochoose[y].offsetLeft;
                closeChoose.style.left=offsetleft+"px";
                closeChoose.style.bottom="400px";
            }
        }
        function closingfunc(){
            const tochoose=document.getElementsByClassName("editor-choose-element");
            const closeChoose=document.getElementById("close-choose");
            for(var i=0; i<tochoose.length; i++){
                tochoose[i].style.display="none";
               
            }
            closeChoose.style.display="none";
            
        }
        
        setTimeout(draggableItems,1000);

        function draggableItems(){
        const draggable = document.getElementsByClassName("draggable");
        for(var i=0; i<draggable.length;i++){
            draggable[i].addEventListener('dragstart', function(event) {
                const data = {
                    id: event.target.id,
                    classes: event.target.className
                };
                const jsonData = JSON.stringify(data);
                event.dataTransfer.setData('application/json', jsonData)
                /*if (event.target.className=="image draggable"){
                    event.dataTransfer.setData('text/plain', event.target.src);
                }
                if (event.target.className=="icon draggable"){
                    event.dataTransfer.setData('text/plain', event.target.src);
                }*/
                if(event.target.tagName=="IMG"){
                    event.dataTransfer.setData('text/plain', event.target.src);
                }
                if(event.target.tagName=="CANVAS"){
                    event.dataTransfer.setData('text/plain', event.target.toDataURL('image/png'));
                }
                dragFromElements=true;
            });
        }
        }
        setTimeout(function(){
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.draggable="true";
                img.id="a";
                img.classList.add('upload');
                img.classList.add('draggable');
                document.getElementById('imageGallery').appendChild(img);
                draggableItems()
            };
            reader.readAsDataURL(file);
            
        });
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
        
        setTimeout(function(){
            const canvas = document.getElementById('drawing-canvas');
            const clear_canvas= document.getElementById('clear-canvas');
            const save_canvas= document.getElementById('save-canvas')

            const ctx = canvas.getContext('2d');
            let drawing = false;

            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseleave', stopDrawing);
            clear_canvas.addEventListener('click',clearDrawing)
            save_canvas.addEventListener('click',saveDrawing)

            function startDrawing(e) {
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(e.offsetX, e.offsetY);
            }

            function stopDrawing() {
                drawing = false;
                ctx.closePath();
            }

            function draw(e) {
                if (!drawing) return;
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        
            function clearDrawing() {
                canvas.setAttribute('draggable', 'false');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                canvas.addEventListener('mousedown', startDrawing);
                canvas.addEventListener('mouseup', stopDrawing);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('mouseleave', stopDrawing);
                save_canvas.innerText="Save";
            }
            function saveDrawing(){
                canvas.removeEventListener('mousedown', startDrawing);
                canvas.removeEventListener('mouseup', stopDrawing);
                canvas.removeEventListener('mousemove', draw);
                canvas.removeEventListener('mouseleave', stopDrawing);
                canvas.setAttribute('draggable', 'true');
                save_canvas.innerText="Saved";
            }
        },1000);


        async function downloadpng() {
                    

                    try {
                        tinymce.activeEditor.dom.select('.selected-node').forEach(function(node) {
                            node.classList.remove('selected-node');
                        });
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();

                        contentElement.scrollIntoView(true);
                        
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY:-window.scrollY,
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
                        tinymce.activeEditor.dom.select('.selected-node').forEach(function(node) {
                            node.classList.remove('selected-node');
                        });
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();
                        contentElement.scrollIntoView(true);
                        
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY: -window.scrollY,
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
        async function downloadpdf(x) {
                    

                    try {
                        tinymce.activeEditor.dom.select('.selected-node').forEach(function(node) {
                            node.classList.remove('selected-node');
                        });
                        const editor = tinymce.get('editor-div'); // Replace with your TinyMCE editor ID
                        const contentElement = editor.getBody();
                        contentElement.scrollIntoView(true);
                        
                        const canvas = await html2canvas(contentElement, {
                            logging: true,
                            useCORS: true,
                            allowTaint: true,
                            scrollX: 0,
                            scrollY: -window.scrollY,
                            });

                        // Convert the canvas to an image data URL
                        let imgData = canvas.toDataURL("image/jpg");
                        
                        if(x==='vertical'){
                            
                            const pdf = new jsPDF('p', 'mm', [240, 340]);
                            const imgWidth = 210;
                            const imgHeight = canvas.height * imgWidth / canvas.width;
                            
                            pdf.addImage(imgData, 'PNG', 15, 15, imgWidth, imgHeight);
                            pdf.save('template.pdf');
                        }
                        else{
                            const pdf = new jsPDF('l', 'mm', [240,170]);
                            const imgWidth = 210;
                            const imgHeight = canvas.height * imgWidth / canvas.width;
                            pdf.addImage(imgData, 'PNG', 15, 15, imgWidth, imgHeight);
                            pdf.save('template.pdf');
                        }
                        
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
                    await downloadpdf(form.page_type);
                });
                });
</script>

<style>
    .tox .tox-statusbar__resize-handle {
        display:none !important;
    }
    .tox-menubar{
        display:none !important;
    }
    .tox .tox-toolbar__primary {
        border-radius:25px;
    }
    .tox .tox-toolbar-overlord{
        border-radius:25px;
    }
    .tox .tox-promotion {
        display:none !important;
    }
    .tox-tbtn:hover{
        background-color:green !important;
    }
    .back-color{
        background-color:green !important;
    }
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
        /*padding:40px;*/
        background-color:#4caf50;
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
        align-items:center;
        justify-content:center;
        font-size:20px;
        background-color: #4caf50;
        border-radius:50%;
        display:none;
        border:2px solid black;
        color:black;
        position:absolute;
        left:500px;
        
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
        width:90%;
        margin:5%;
        padding:5%;
        border:2px solid  #4caf50;
        box-shadow:5px 5px 5px #aed581;
        border-radius:20px;
        background-color:white;

    }
    .editor-choose-option::-webkit-scrollbar-track{
        
    }
    #upload-image-input{
        width:90%;
        height:200px;
        display:flex;
        align-items:center;
        justify-content:center;
        border:2px solid #aed581;
        border-radius:20px;
        margin:20px 5% 20px 5%;
        
    }
    #imageUpload{
        display:none;
    }
    #upload-btn{
        border:2px solid #aed581;
        padding:12px;
    }
    #imageGallery{
        width:90%;
        border:2px solid #aed581;
        border-radius:20px;
        margin:20px 5% 20px 5%;
    }
    #imageGallery img{
        width:90%;
        margin:5%;
    }
    .draggable{
        box-shadow:5px 5px 5px  #aed581;
        background-color:white;
        border:2px solid #aed581;
    }
    .canvas-btn{
        background-color:#aed581;
        width:120px;
        height:30px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin: 5px 0 5px 0;
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
    #drawing-canvas{
        margin:5%;
        width:90%;
        height:150px;
        background-color:transparent;
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
    #capturejpg{
        width:55px;
        height:55px;
        margin:10px;
        background-color:white;
        font-size:18px;
        border-radius:50%;
        color:black;
    }
    #capturepng{
        width:55px;
        height:55px;
        margin:10px;
        background-color:white;
        font-size:18px;
        border-radius:50%;
        color:black;
    }
    #capturepdf{
        width:55px;
        height:55px;
        margin:10px;
        background-color:white;
        font-size:18px;
        border-radius:50%;
        color:black;
    }
    #help{
        margin:auto;
        width:90px;
        height:30px;
        background-color:#4caf50;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:20px;
        margin-top:20px;
        margin-bottom:20px;
    }
    #help-statements{
        width:90%;
        margin:auto;
        text-align:justify;
        padding:20px;
        border:2px solid #4caf50;
        border-radius:20px;
        box-shadow: 5px 5px 5px #4caf50;
    }
    @media(max-width:700px){
        .tox-tinymce{
            width:100% !important;
            height:500px !important;
            
        }
    }
    @media(max-width:1050px) and (min-width:1000px){
        .editor-choose-element{
            width:220px;
            overflow-x:scroll;
        }
        .editor-choose-element-inner{
            width:190px;
            margin:15px;
            padding:15px;
        }
        .editor-heading{
            font-size:15px;
        }
        .editor-choose-option{
            width:150px;
        }
        .draggable{
            min-width:90% !important;
        }
        .image{
            height:90px;
        }
        .vertical{
            height:200px;
        }
        .horizontal{
            height:90px;
        }
    }
    @media(max-width:1000px){   
        #editor-main{
            flex-direction:column-reverse;
            width: 100%;
            height:400px;
            position:fixed;
            bottom:0;
            z-index:5;
            margin:auto;
            top:auto;
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
            width:420px;
            height:300px;
            border:10px solid #aed581 ;
            margin:auto;
            margin-bottom:0;
        }
        .card{
            width:100% !important;
            
        }
        #close-choose{
            
        }
        
    }
    @media(max-width:400px){ 
        .editor-choose-element{
            width:100%;
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
        @if($template->page_type=="vertical" && $template->image_transparacy=="0")
            <img id="{{$template->sid}}" draggable="true" class="backgroundV draggable vertical" src="{{ asset($template->background_image)}}" >
        @endif
    @endforeach
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Blank Pages(horizontal)</div>
    <div id="blanksH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal" && $template->image_transparacy=="0")
            <img id="{{$template->sid}}" draggable="true" class="backgroundH draggable horizontal" src="{{ asset($template->background_image)}}">
        @endif
        @endforeach
    </div>
    </div>
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Back Images(vertical)</div>
    <div id="backgroundsV" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="vertical" && $template->image_transparacy!="0")
            <img id="{{$template->sid}}" draggable="true" class="backgroundV draggable vertical" src="{{ asset($template->background_image)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">back Images(horizontal)</div>
    <div id="backgroundsH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal" && $template->image_transparacy!="0")
            <img id="{{$template->sid}}" draggable="true" class="backgroundH draggable horizontal" src="{{ asset($template->background_image)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">Templates(vertical)</div>
    <div id="templatesV" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="vertical")
            <img id="{{$template->sid}}"draggable="true" class="templateV draggable vertical" src="{{ asset($template->template_type)}}">
        @endif
        @endforeach
    </div>
    </div>

    <div class="editor-choose-element-inner">
    <div class="editor-heading">Templates(horizontal)</div>
    <div id="templatesH" class="editor-choose-option">
        @foreach ($forms as $template)
        @if($template->page_type=="horizontal")
            <img id="{{$template->sid}}"draggable="true" class="templateH draggable horizontal" src="{{ asset($template->template_type)}}">
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
        <div id="plain-table"class="table draggable" draggable="true"><img draggable="false"width="80px"height="80px"src="{{asset('/img/0.png')}}" ></div>
        <div id="pink-table"class="table draggable" draggable="true"><img draggable="false"width="80px"height="80px"src="{{asset('/img/1.png')}}" ></div>
        <div id="blue-table"class="table draggable" draggable="true"><img draggable="false"width="80px"height="80px"src="{{asset('/img/2.png')}}" ></div>
        <div id="olive-table"class="table draggable" draggable="true"><img draggable="false"width="80px"height="80px"src="{{asset('/img/3.png')}}" ></div>
        <div id="first-row-pink-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/4.png')}}" ></div>
        <div id="first-row-blue-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/5.png')}}" ></div>
        <div id="first-row-olive-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/6.png')}}" ></div>
        <div id="first-row-first-column-pink-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/7.png')}}" ></div>
        <div id="first-row-first-column-blue-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/8.png')}}" ></div>
        <div id="first-row-first-column-olive-table"class="table draggable" draggable="true"><img draggable="false" width="80px"height="80px"src="{{asset('/img/9.png')}}" ></div>
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
    <div class="editor-choose-element-inner">
    <div class="editor-heading">Signature</div>
    <div id="signature" class="editor-choose-option">
        <canvas id="drawing-canvas" class="sign draggable"></canvas>
    </div>
        <div id="clear-canvas" class="canvas-btn">clear</div>
        <div id="save-canvas" class="canvas-btn">save</div>
    </div>
</div>
<div class="editor-choose-element">
    <div id="upload-image-input">
    <label for="imageUpload" id="upload-btn">Upload Image</label>
    <input type="file" id="imageUpload" accept="image/*">
    </div>
    <div id="imageGallery"></div>
</div>
<div class="editor-choose-element">
<div id="help">Help</div>
<div id="help-statements">
    <ul>
        <li>You can drag and drop any blank page, blank background or pre-built template to the editor from the template option given at the sidebar.</li>
        <li>You can drag and drop any element (text, line, image, signature) to the template from the element option given at the sidebar.</li>
        <li>If you want to add any image from your pc, you can go to the upload option given at the sidebar. Once image is uploaded, you can drag it to editor.</li>
        
    </ul>
</div>
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
            <h1 class="div-resizable-draggable" style="position:absolute;top:150px;left:80px;">Start creating your template</h1>
            @endif
            
            {{--
            <div style="background-color:blue;width:200px;height:200px;"><div>aditi</div><div>vijay</div></div>
            <div class="div-resizable div-resizable-draggable"style="border:2px solid black;">aditi </div>
            
            <img class="div-resizable-draggable"style=""src="{{asset('/img/select-image4.jpg')}}">
            <p  class="div-resizable-draggable">aditi</p>
            --}}
            </textarea>
            <button  type="button" id="capturepng" class="btn btn-success btn-sm float-end">PNG</button>
            <button  type="button" id="capturejpg" class="btn btn-success btn-sm float-end">JPG</button>
            <button  type="button" id="capturepdf" class="btn btn-success btn-sm float-end">PDF</button>
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


















