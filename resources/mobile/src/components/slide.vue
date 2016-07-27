<template>
<div class="flexslider">
    <ul class="slides">
        <li style="background:url({{ $casa->pic }}) ; background-size:100% 100%;">
            <a href="casa/{{ $casa->casa_id }}" target="_blank" class="slide-a">
                <div class="slide-mess">
                    {{$casa->title }}
                </div>
            </a>
        </li>
    </ul>
</div>
</template>
<script>
    
</script>