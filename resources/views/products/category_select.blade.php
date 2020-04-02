
<select id="categories" name="category">
    @if(count($categories)>0)
    @foreach($categories as $category)
    <option value="{{$category->id}}" @if($category->isSelected) selected @endif>{{$category->name}}</option>
    @endforeach
    @endif
</select>
<input type="text" id="input_new_category" value="" placeholder="New Category"/>
<button type="button" id="btn_new_category" onclick="onNewCategoryBtnClicked()">Add</button>
<script>
    function onNewCategoryBtnClicked(){
        var newCategoryInputElement = document.getElementById('input_new_category');
        var categoriesSelectElement = document.getElementById('categories');
        let newOption = newCategoryInputElement.value;
        newCategoryInputElement.value = "";
        httpGetAsync("/category_store",'{"new_category":"'+newOption+'"}',function(response){
            let data = JSON.parse(response);
            console.log(data);
            if(data.status === "OK"){
                categoriesSelectElement.innerHTML+="<option value='"+data.new_category_id+"' selected>"+data.new_category+"</option>"
            }else{
                for(var i = 0; i<categoriesSelectElement.options.length; i++){
                    if(data.new_option === categoriesSelectElement.options[i].value){
                        categoriesSelectElement.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    }
    document.getElementById('input_new_category').addEventListener("keyup",function(event){
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