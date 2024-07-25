@extends('layouts.app')

@section('content')


<script>
    var form= @json($form);
    if (form.background_image=="none"){
    height=((700/form.paper_size.split('X')[0])*form.paper_size.split('X')[1])+160;
    width=700;
    }
    else{
        height=(Number(form.paper_size.split('X')[1])+Number(200)).toString();
        
        width=(Number(form.paper_size.split('X')[0])+Number(100)).toString();
    }
    address="url('"+form.background_image+"')";
    tinymce.init({
        selector: '.content',
        content_css: "/css/tinymce.css",
        resize:"both",
        height:height,
        width:width,
        valid_children: '-p[img]',
        focus:false,
        setup: function (editor) { 
            
            editor.on('init', function () {
                editor.getDoc().body.style.backgroundImage =address;
                editor.getDoc().body.style.backgroundColor= "none";
                editor.getDoc().body.style.backgroundSize = "cover";
                editor.getDoc().body.style.backgroundRepeat = "no-repeat"; 
                editor.getDoc().body.style.overflow = "hidden"; 
                editor.getDoc().body.style.margin= "0 !important"; 
                //editor.getDoc().body.style.border = "5px solid black";
                //applyResizableToDivs(editor.getDoc().body);
                
                //ensureTrailingParagraph(editor)
                // Re-apply resizable handles whenever content changes 
                
                
                children=editor.getDoc().body.childNodes
                
                /*for(var i=0;i<children.length;i++){
                    children[i].classList.add('div-resizable-draggable');
                }*/
                setTimeout(applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement),1000);
                //uneditableP(editor)
            });  
            editor.on('NodeChange', function (e) {
                    //applyResizableToDivs(editor.getDoc().body);
                    //uneditableP(editor)
                    console.log(editor.getDoc().body.querySelectorAll('.div-resizable-draggable'))
                    applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                    tinymce.activeEditor.dom.select('.selected-node').forEach(function(node) {
                        node.classList.remove('selected-node');
                    });
                    if (e.element) {
                            e.element.classList.add('selected-node');
                    }
                    //ensureTrailingParagraph(editor)
                    
            });  
            
            editor.on('setContent', function () {
                    //applyResizableToDivs(editor.getDoc().body);
                    applyDraggableToDivs(editor,editor.getDoc().body,editor.iframeElement);
                    //ensureTrailingParagraph(editor)
            });
            
            editor.on('click', function (e) {
                
                //console.log(editor.selection.getStart(), editor.getDoc().body)
                if (e.target === editor.getDoc().body) {
                    e.preventDefault()
                    first=editor.getBody().firstChild
                    editor.selection.select(first,true)
                    editor.selection.collapse(true);
                }
            });
            editor.on('drop', function(event) {
                event.preventDefault();
                event.stopPropagation();
                const jsonData= event.dataTransfer.getData('application/json');
                const information= JSON.parse(jsonData);
                const id=information.id
                const classes=information.classes
                const dropPosition = editor.selection.getRng().startOffset;
                console.log(dropPosition)
                if (dropPosition){
                editor.selection.setCursorLocation(editor.selection.getNode(), dropPosition);
                
                }
                if (classes=="space draggable"){
                    const selectedElement = editor.selection.getNode();
                    const hrElement = editor.dom.create('br');
                    selectedElement.insertAdjacentElement('afterend', hrElement);
                }
                if (id=="solid-line"){
                    //const hrElement = '<hr>';
                    //editor.insertContent(hrElement);
                    //hrElement.classList.add("div-resizable-draggable");
                    const newElement = editor.dom.create('hr', { class: 'div-resizable-draggable' });
                    //editor.insertContent(editor.dom.getOuterHTML(hrElement));
                    const rect = editor.getDoc().body.getBoundingClientRect();
                    editor.getDoc().body.position="absolute";
                    const x = event.clientX ;
                    const y = event.clientY;

                    newElement.style.left = `${x}px`;
                    newElement.style.top = `${y}px`;

                    editor.getDoc().body.appendChild(newElement);
                }
                if (id=="thick-line"){
                    editor.insertContent('<hr style="border:none;border-top:5px solid black;">');
                }
                if (id=="dotted-line"){
                    editor.insertContent('<hr style="border:none;border-top:5px dotted black;">');
                }
                if (id=="dashed-line"){
                    editor.insertContent('<hr style="border:none;border-top:5px dashed black;">');
                }
                if (id=="double-line"){
                    editor.insertContent('<hr style="border:none;border-top:5px double black;">');
                }
                if (id=="plain-table"){
                    editor.insertContent('<table width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                }
                if (id=="pink-table"){
                    editor.insertContent('<table class="pinktable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');                    
                    
                }
                if (id=="blue-table"){
                    editor.insertContent('<table class="bluetable" width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="olive-table"){
                    editor.insertContent('<table class="olivetable" width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-pink-table"){
                    editor.insertContent('<table class="firstrowpinktable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-blue-table"){
                    editor.insertContent('<table class="firstrowbluetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-olive-table"){
                    editor.insertContent('<table class="firstrowolivetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-first-column-pink-table"){
                    editor.insertContent('<table class="firstrowfirstcolumnpinktable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-first-column-blue-table"){
                    editor.insertContent('<table class="firstrowfirstcolumnbluetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="first-row-first-column-olive-table"){
                    editor.insertContent('<table class="firstrowfirstcolumnolivetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
                
                }
                if (id=="two-simple-column"){
                    editor.insertContent('<table class="column-using-table" width="100%"><colGroup><col width="50%"><col width="50%"></colGroup><td class="table-column"></td><td class="table-column"></td></table>');
                    
                }
                if(id=="three-simple-column"){

                }
                if (id=="info-block"){
                    editor.insertContent('<div style="background-color:#B3E5FC ;"class="block-div"><img class="block-img"src="{{asset("/img/info.png")}}"><div class="block-content"><div class="block-title">Info</div><div >Write your content here.</div></div></div>')
                }
                if (id=="note-block"){
                    editor.insertContent('<div  style="background-color:#CFD8DC ;"class="block-div"><img class="block-img" src="{{asset("/img/message.png")}}"><div class="block-content"><div class="block-title">Note</div><div>Write your content here.</div></div></div>')
                
                }
                if (id=="warning-block"){
                    editor.insertContent('<div  style="background-color:#FFECB3 ;"class="block-div"><img class="block-img" src="{{asset("/img/warning.png")}}"><div class="block-content"><div class="block-title">Warning</div><div>Write your content here.</div></div></div>')
                
                }
                if (id=="success-block"){
                    editor.insertContent('<div  style="background-color:#DCEDC8;"class="block-div"><img class="block-img"src="{{asset("/img/success.png")}}"><div class="block-content"><div class="block-title">Success</div><div>Write your content here.</div></div></div>')
                
                }
                if (id=="error-block"){
                    editor.insertContent('<div  style="background-color:#FFCCBC;" class="block-div"><img class="block-img"src="{{asset("/img/error.png")}}"><div class="block-content"><div class="block-title">Error</div><div>Write your content here.</div></div></div>')
                
                }
                if (id=="quotation-block"){
                    editor.insertContent('<div  style="background-color:#D1C4E9 ;" class="block-div"><img class="block-img"src="{{asset("/img/quote.png")}}"><div class="block-content"><div class="block-title">Quotation</div><div>Write your content here.</div></div></div>');
                
                }
                if (id=="upload-image"){
                    
                }
                if (classes=="image draggable"){
                    x= event.dataTransfer.getData('text/plain');
                    editor.insertContent(`<img src="${x}" class="div-resizable-draggable">`);

                }
                
            });
            
            editor.on('dragover', function(event) {
                event.preventDefault();
            }); 
               
            editor.on('keydown', function (e) {
            if (e.keyCode == 13) { // 13 is the keycode for Enter
                e.preventDefault();
                editor.execCommand('InsertLineBreak');
              
            }
            });
            editor.ui.registry.addButton('deleteSelectedElement', {
                    text: 'Delete Element',
                    onAction: function () {
                        // Get the selected node
                        var selectedNode = editor.selection.getNode();
                        // Check if a node is selected
                        while (selectedNode && (selectedNode.tagName !== "DIV" && selectedNode.tagName !== "HR" && selectedNode.tagName !== "TABLE" && selectedNode.tagName !== "IMG") ) {
                            selectedNode = selectedNode.parentNode;
                        }
                        if (selectedNode) {
                            // Remove the selected node
                            console.log("aditi")
                            selectedNode.remove();
                        }
                    }
            });
        },
        plugins: 'noneditable code table lists insertdatetime link',
        toolbar: 'deleteSelectedElement undo redo|deleteButton| bold italic  underline forecolor |formatselect| alignleft aligncenter alignright alignjustify| indent outdent | bullist numlist | table | tableprops ',
        insertdatetime_dateformat: '%d-%m-%Y',
        content_style: `html { height:100%; background-color:#F5EEF8;}body{height:100%;width:100%;line-height: 1;position:absolute; }`,
        
        });
        /*
        function ensureTrailingParagraph(editor) {
                    const body = editor.getBody();
                    const lastChild = body.lastChild;
                    if (!lastChild || lastChild.nodeName !== 'P') {
                        editor.setContent(editor.getContent() + '<p>End of the page</p>');
                    }
        }*/
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
            });
        }
        },1000);
        function uneditableP(editor){
            editor.getBody().querySelectorAll('img').forEach(function (img) {
                    var parentP = img.closest('p');
                    if (parentP && !parentP.classList.contains('uneditable')) {
                        parentP.classList.add('uneditable');
                    }
                    });
        }
        function applyDraggableToDivs(editor,body,frame) {
                    const divs = body.querySelectorAll('.div-resizable-draggable');
                    divs.forEach(div => {
                        makeDraggable(div,editor,body,frame);
                    });
                }
        
        function makeDraggable(div,editor,body,frame) {
                    /*if (div.querySelector('.drag-handle')) return;

                    // Create the drag handle
                   
                    const dragHandle = document.createElement('div');
        
                    dragHandle.classList.add('drag-handle');

                    // Append drag handle to the div
                    div.appendChild(dragHandle);
                    */
                    // Add mouse event listeners for dragging
                    let isDragging = false;
                    let startX, startY, initialMouseX, initialMouseY;

                    div.addEventListener('mousedown', function (e) {
                            //e.preventDefault();
                            
                            const rect = div.getBoundingClientRect();
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

                            // Ensure the div stays within the bounds of the iframe
                            const maxLeft = iframeRect.width - div.offsetWidth;
                            const maxTop = iframeRect.height - div.offsetHeight;

                            //div.style.position = 'absolute';
                            div.style.left = Math.min(Math.max(newLeft, 0), maxLeft) + 'px';
                            div.style.top = Math.min(Math.max(newTop, 0), maxTop) + 'px';
                        
                    }


                    function onMouseUp() {
                            
                            isDragging = false;
                            editor.getDoc().removeEventListener('mousemove', onMouseMove);
                            editor.getDoc().removeEventListener('mouseup', onMouseUp);
                    }
                }
            
                
</script>
<style>
    
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
        
    }
    .card-header{
        background-color:white;
        height:40px;
    }
    .card-body{
        width:fit-content;
        height:fit-content;
        padding:40px;
        background-color:;
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
        background-color:white ;
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
    }
    .editor-choose-element{
        width:400px;
        height:100%;
        background-color:white ;
        display:none;
        box-shadow:5px 5px 10px 10px #CFD8DC ;
        color:black;
        overflow-y:scroll;
    }
    #close-choose{
        width:25px;
        height:25px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        background-color:white ;
        border-radius:50%;
        display:none;
        border:2px solid black;
        margin: 0 0 0 10px;
        color:black;
    }
    .written-option{
        margin:5px 0 5px 0;
    }
    hr{
        color:white;
        width: 100px;
        opacity:1;
    }
    .editor-choose-option{
        width:100%;
        display:flex;
        overflow-x:scroll;
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
    .editor-heading{
        font-size:22px;
    }
    .editor-choose-element-inner{
        margin:20px;
        padding:20px;
        border:2px solid black;
        border-radius:20px;
    }
    .column{
        min-width:40%;
        margin:5%;
        height:120px;
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
    .image img{
        width:100%;
        height:100%;
        border-radius:10px;
    }
    .tox{
        z-index:0 !important;
    }
    .space{
        height:20px;
        min-width:40%;
        margin:5%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        border:2px solid black;
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
            width:100%;
            
        }
        #close-choose{
            margin:5px 0 5px 0;
        }
    }
</style>
{{--
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mt-5">
                <div class="card-header">  <h3>Form One</h3></div>
                <div class="card-body">
                    <!-- Insert the blade containing the TinyMCE placeholder HTML element -->
                    <form method="get" action="{{ route('export-pdf') }}">
                        @csrf
                        <textarea name="content" class="content">
                            <p class="MsoNormal">&nbsp;</p>

                            <table style="border-collapse: collapse; width: 100%; border-width: 0px;  border-style: none;" ><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
                                <tbody>
                                <tr>
                                <td style="border-width: 0px; "><strong>No. C&amp;W/Cons/NV/..... /23/A/B-.......&nbsp;</strong></td>
                                <td style="border-width: 0px; text-align: right;"><strong></strong></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh presents its compliments to (*4.Name of the Embassy/High Commission: the High Commission of Canada) in Dhaka and has the honour to inform that the following officials/delegation/persons of (1. the organization name: Ministry of Information) Government of the People&rsquo;s Republic of Bangladesh would like to visit 3. Country: Canada from (8. date........) to (date...........) to attend the (6. &ldquo;name of the event...............................&rdquo;) to be held from (7. date ..... to date........) in 9. Event location , (3. country name: Canada):</p>
                            <p class="MsoNormal">2*</p>
                            <p class="MsoNormal">Sl. No.<span style="mso-tab-count: 1;">&nbsp;&nbsp; </span>Name &amp; Designation <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp; </span>Passport No.</p>
                            <p class="MsoNormal">01.<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>( Address as per gender) Mr./Ms................<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
                            <p class="MsoNormal">02.<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>( Address as per gender) Mr./Ms................<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry would appreciate if the esteemed Embassy/High Commission could kindly endorse necessary visa in their favor.</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh avails itself of this opportunity to renew to the (4*Embassy name High Commission of Canada) in Dhaka the assurances of its highest consideration.</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal"><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dhaka, (10*current date)</p>
                            <p class="MsoNormal">(4*Embassy name: High Commission of Canada)</p>
                            <p class="MsoNormal">Dhaka</p>
                        </textarea>
                        <button type="submit" class="btn btn-success btn-sm float-end">Download PDF</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
--}}
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
    <div class="editor-heading">Spaces</div>
    <div id="lines" class="editor-choose-option">
        <div id="solid-space"class="space draggable" draggable="true"></div>
        <div id="thick-space"class="space draggable" draggable="true"></div>
        <div id="dotted-space"class="space draggable" draggable="true"></div>
        <div id="dashed-space"class="space draggable" draggable="true"></div>
        <div id="double-space"class="space draggable" draggable="true"></div>
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
    <div class="editor-heading">Columns</div>
    <div id="columns" class="editor-choose-option">
        <div id="two-simple-column"class="column draggable" draggable="true"></div>
        <div id="three-simple-column"class="column draggable" draggable="true"></div>
        <div id="-column"class="column draggable" draggable="true"></div>
        <div id="-column"class="column draggable" draggable="true"></div>
        <div id="double-column"class="column draggable" draggable="true"></div>
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
    <div class="editor-heading">Blocks</div>
    <div id="blocks" class="editor-choose-option">
        <div id="info-block"class="block draggable" draggable="true" style="background-color:#B3E5FC;"><img src="{{asset('/img/info.png')}}"></div>
        <div id="note-block"class="block draggable" draggable="true" style="background-color:#CFD8DC;"><img src="{{asset('/img/message.png')}}"></div>
        <div id="warning-block"class="block draggable" draggable="true" style="background-color:#FFECB3;"><img src="{{asset('/img/warning.png')}}"></div>
        <div id="success-block"class="block draggable" draggable="true" style="background-color:#DCEDC8;"><img src="{{asset('/img/success.png')}}"></div>
        <div id="error-block"class="block draggable" draggable="true" style="background-color:#FFCCBC;"><img src="{{asset('/img/error.png')}}"></div>
        <div id="quotation-block"class="block draggable" draggable="true" style="background-color:#D1C4E9;"><img src="{{asset('/img/quote.png')}}"></div>
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
        <form id="form" method="get" action="{{route('export-pdf')}}">
        @csrf
            <textarea class="content " name="editor-div"id="editor-div">
            {{--<div  style="background-color:#FFCCBC;" class="block-div"><img class="block-img"src="{{asset('/img/error.png')}}"></div><div class="block-content"><div class="block-title">Error</div><div>Write your content here.</div></div></div>
            <div></div>
            <table class="firstrowfirstcolumnolivetable"width="100%"><colGroup><col width="33.3%"><col width="33.3%"><col width="33.3%"></colGroup><tbody><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></tbody></table>
            <img src="{{asset('/img/select-image1.jpg')}}">
            --}}
            {!!$form->content!!}
            {{--
            
            <div style="background-color:blue;width:200px;height:200px;"><div>aditi</div><div>vijay</div></div>
            <div style="border:2px solid black;">aditi </div>
            
            <img class="div-resizable-draggable"style=""src="{{asset('/img/select-image4.jpg')}}">
            <p  class="div-resizable-draggable">aditi</p>
            --}}
            </textarea>

@endsection