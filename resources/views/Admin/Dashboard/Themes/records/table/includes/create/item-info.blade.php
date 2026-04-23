<div id="step-5" class="step d-none">
    @if(session()->has('step-4') && !empty(session('item')))
        @php
            $item = session('item', []);
        @endphp

        <div class="rounded box-shadow my-5">
            <h6 class="bg p-2">Datos</h6>
            <div class="p-4">
                @if(!empty($item['name']))
                    <h4 class="text-center fw-bold mb-3">{{ $item['name'] }}</h4>
                @endif

                @if(!empty($item['selected_images']))
                    <div class="d-flex justify-content-center gap-2">
                        @foreach($item['selected_images'] as $imageId)
                            @php
                                $image = collect($images)->firstWhere('id', $imageId);
                            @endphp
                            @if($image)
                                <div data-id="{{ $image->id }}">
                                    <p class="text-center fw-bold m-0">{{ $image->code }}</p>
                                    <img src="{{ asset($image->path) }}" 
                                        alt="img" 
                                        class="img-fluid" 
                                        style="width:90px; height:90px; object-fit:cover;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Numero de registro CAS</th>
                            <td>{{ $item['cas_number'] ?? 'Desconocido' }}</td>
                        </tr>
                        <tr>
                            <th scope="row"># ONU asociado(s)</th>
                            <td>{{ $item['onu_number'] ?? 'Desconocido' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cantidad mensualmente almacenada</th>
                            <td>{{ !empty($item['monthly_stored']) ? $item['monthly_stored'].' Kg' : 'Desconocido' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cantidad mensualmente utilizada</th>
                            <td>{{ !empty($item['monthly_used']) ? $item['monthly_used'].' Kg' : 'Desconocido' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Puntaje</th>
                            <td>{{ $item['score'] ?? 'Desconocido' }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">Actividades económicas asociadas</th>
                            <td>
                                @if(!empty($item['details']['economy']))
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($item['details']['economy'] as $economy)
                                            <span class="badge bg-secondary">{{ $economy }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">No registradas</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Categorías de peligros asociados de acuerdo con el sistema globalmente armonizado (ONU,2015)</th>
                            <td>
                                @if(!empty($item['details']['danger']))
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($item['details']['danger'] as $danger)
                                            <span class="badge bg-secondary">{{ $danger }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">No registradas</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-secondary prev-step me-2">Anterior</button>
            <form action="{{ route('admin.themes.record.item.store', ['module' => $module, 'page_id' => $page_id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Crear</button>
            </form>
        </div>
    @endif
</div>
