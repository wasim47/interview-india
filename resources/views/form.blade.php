<html>
    <head>
        <title>Form</title>
               <!-- CSS only -->
			<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        <style>
			
        	input[type="text"]{
				 width:100%;
				 padding:3px;
				 height:35px;
				 border:1px solid #663300;
				 border-radius:5px;
			}
			input[type="submit"]{
				 width:auto;
				 padding:10px 15px;
				 border:1px solid #ccc;
				 border-radius:5px;
				 background:#66CC66;
				 color:#fff;
				 font-size:15px;
			}
			h2{
				width:100%;
				text-align:center;
				color:green;	
			}
			h3{
				width:100%;
				text-align:center;
				color:red;	
				font-size:13px;	
			}
			h4{
				width:100%;
				text-align:center;
				color:ccc;	
				padding:50px;
			}
			.formWrapping{
				width:30%;
				float:left;
				margin:1%;	
			}
			.listWrapping{
				width:58%;
				float:left;
				margin:1% 5%;	
			}
        </style>
 
    </head>
    <body>
    	<div class="formWrapping">
    	@if(session()->has('success'))
        	<h2>{{ session()->get('success')}}</h2>
        @endif
        
        @if(session()->has('error'))
        	<h3>{{ session()->get('error')}}</h3>
        @endif
        
        @if($errors->any())
            {!! implode('', $errors->all('<h3>:message</h3>')) !!}
        @endif
        
    	<form action="/formSubmit" method="post" enctype="application/x-www-form-urlencoded">
        {{ csrf_field() }}
        <table width="100%" class="table-bordered">
        	<tr>
            	<td align="right">Account ID</td>
                <td align="center">:</td>
                <td><input type="text" name="account_id"></td>
            </tr>
            <tr>
            	<td align="right">Introducer ID</td>
                <td align="center">:</td>
                <td><input type="text" name="introducer_id"></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
        </form>
        </div>
        
        	<div class="listWrapping">        
             <table width="100%"  class="table-bordered">
                <tr>
                    <td align="center">SI</td>
                    <td align="center">Account No.</td>
                    <td align="center">Introducer ID</td>
                    <td align="center">Beneficiary ID</td>
                </tr>
                @if(count($data) > 0)
                    @foreach($data as $d)
                        <tr>
                            <td align="center">{{ $loop->iteration}}</td>
                            <td align="center">{{ $d->account_id }}</td>
                            <td align="center">{{ $d->introducer_id }}</td>
                            <td align="center">{{ $d->beneficiary_id }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="center">{{ $data->links() }}</td>
                    </tr>
                @else
                	<tr>
                        <td colspan="4" align="center"> <h4>No Data Found</h4></td>
                    </tr>
                   
                @endif
            </table>
        </div>
    </body>
</html>