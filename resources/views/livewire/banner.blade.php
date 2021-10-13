<div class="bg-red-700">
    <div class="container">
        @if ($pendientes > 0)
            <div class="px-4 py-2 leading-normal text-red-100" role="alert">
                <p> {{$message}} </p>
            </div>  
        @endif
    </div> 
</div>

