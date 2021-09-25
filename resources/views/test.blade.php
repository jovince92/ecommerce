<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <table style="border: 1px solid black;    border-collapse: collapse;">
        <tr  style="border: 1px solid black;    border-collapse: collapse;">
          <th style="border: 1px solid black;    border-collapse: collapse;">Category</th>
          <th style="border: 1px solid black;    border-collapse: collapse;">SubCategories</th>
          <th style="border: 1px solid black;    border-collapse: collapse;">SubSubCategories</th>
        </tr>
        @foreach ($categories as $category)
        <tr style="border: 1px solid black;    border-collapse: collapse;">
            <td style="border: 1px solid black;    border-collapse: collapse;">{{ $category->category_name_en }} </td>
            <td style="border: 1px solid black;    border-collapse: collapse;">
                @foreach ($category->subcategory as $subcategory)
                    {{ $subcategory->subcategory_name_en }}    <br>              
                @endforeach
            </td>
            <td style="border: 1px solid black;    border-collapse: collapse;">
                @foreach ($category->subsubcategory_pivot as $subsubcategory)
                {{ $subsubcategory->subsubcategory_name_en }}  <br>
                @endforeach                
            </td>
                
         
        </tr>
        @endforeach
       
       
      </table>
    
</body>
</html>