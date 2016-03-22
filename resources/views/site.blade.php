<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!! Form::open(['url'=>'/213']) !!}
   <div class="form-group">
       {!! Form::label('title','标题:') !!}
       {!! Form::text('title',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::label('content','正文:') !!}
       {!! Form::textarea('content',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::submit('发表文章',['class'=>'btn btn-primary form-control']) !!}
   </div>
{!! Form::close() !!}
</head>
</html>
