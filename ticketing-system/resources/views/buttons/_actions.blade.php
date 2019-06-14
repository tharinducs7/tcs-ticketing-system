@inject('UtilitiService', 'App\Services\UtilityService')

<td>

    @if($UtilitiService->getAccessUpdate(Request::segment(1)=="Yes"))

    <a href="/{{Request::segment(1)}}/update/{{ $element->id }}"
        class="btn btn-grd-info btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="UPDATE">
        <i class="ti-pencil"></i>
    </a>

    @endif
    @if($UtilitiService->getAccessView(Request::segment(1)=="Yes"))

    <a href="/{{Request::segment(1)}}/view/{{ $element->id }}"
        class="btn btn-grd-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="VIEW">
        <i class="ti-eye"></i>
    </a>


    @endif


</td>



    {{-- <td>  
        <form action="{{ route(Request::segment(1).'-destroy', $element->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-grd-danger btn-sm waves-effect waves-light" type="submit"data-toggle="tooltip" data-placement="top" title="" data-original-title="DELETE"><i class="ti-trash"></i></button>
        </form>
    </td> --}}


    