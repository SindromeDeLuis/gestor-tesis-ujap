                                    <!-- Modal Eliminar -->
                                    <div class="modal fade" id="modalEliminar-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro que desea eliminar este registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form method="post" action="{{ route('user.destroy', $user->id) }}">
                                                        @method('delete') @csrf
                                                        <input  type="submit" class="btn btn-danger" value="Eliminar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
