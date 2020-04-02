<div id="categories">
    @if(count($categories)>0)
    @foreach($categories as $category)
    <div><input type="text" value="{{$category->name}}" onchange="onInputChange(this)" class="category_input"/>
        <span>({{$category->count}})</span>
        <button class="btn btn-danger" onclick="onDeleteClicked({{$category->id}},this)">Delete</button>
        <button class="btn btn-secondary save_button" onclick="onSaveClicked({{$category->id}},this)" style="display:none">Save</button>
    </div>
    @endforeach
    @endif
</div>
<input type="text" id="input_new_category" value="" placeholder="New Category"/>
<button id="btn_new_category">Add</button>
<script>
    function onInputChange(element){
        element.parentNode.getElementsByClassName("save_button")[0].style.display="inline";
    }
    function onDeleteClicked(id,element){
        httpGetAsync("/category_destroy/"+id,null,function(response){
            let data = JSON.parse(response);
            if(data.status === "OK"){
                element.parentNode.parentNode.removeChild(element.parentNode);
                console.log(data);
            }else{
                console.log(data);
            }
        });
    }
    function onSaveClicked(id,element){
        let new_category = element.parentNode.getElementsByClassName("category_input")[0].value;
        httpGetAsync("/category_update/"+id,'{"new_category":"'+new_category+'"}',function(response){
            let data = JSON.parse(response);
            if(data.status === "OK"){
                element.style.display="none";
                console.log(data);
            }else{
                console.log(data);
            }
        });
    }
    var newCategoryBtnElement = document.getElementById('btn_new_category');
    var newCategoryInputElement = document.getElementById('input_new_category');
    var categoriesSelectElement = document.getElementById('categories');
    newCategoryBtnElement.onclick = function (){
        if(newCategoryInputElement.value==="")return;
        let newOption = newCategoryInputElement.value;
        newCategoryInputElement.value = "";
        httpGetAsync("/category_store",'{"new_category":"'+newOption+'"}',function(response){
            let data = JSON.parse(response);
            console.log(data);
            if(data.status === "OK"){
                categoriesSelectElement.innerHTML+=`
                <div><input type="text" value="`+data.new_category+`" onchange="onInputChange(this)" class="category_input"/>
                    <span>(0)</span>
                    <button class="btn btn-primary" onclick="onDeleteClicked(`+data.new_category_id+`,this)">Delete</button>
                    <button class="btn btn-secondary save_button" onclick="onSaveClicked(`+data.new_category_id+`,this)" style="display:none">Save</button>
                </div>
                `;
            }else{
                console.log(data);
            }
        });
    }
    newCategoryInputElement.addEventListener("keyup",function(event){
        if(event.keyCode === 13){
            event.preventDefault();
            newCategoryBtnElement.click();
        }
    });


    function httpGetAsync(theUrl, jsonStr,callback)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() { 
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                callback(xmlHttp.responseText);
        }
        xmlHttp.open("POST", theUrl, true); // true for asynchronous 
        xmlHttp.setRequestHeader("Content-Type","application/json;charset=UTF-8");
        xmlHttp.setRequestHeader("X-CSRF-TOKEN","{{csrf_token()}}");
        xmlHttp.send(jsonStr);
    }

</script>