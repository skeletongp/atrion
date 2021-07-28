    <div class="z-50 mt-2  ">

        <div class="flex items-center justify-between lg:w-2/3 mx-auto">
            <button onclick="openModal('{{ $modalId }}')" title="Editar"
                class="modal-open bg-transparent  text-gray-900 hover:text-indigo-500 font-bold  rounded-full outline-none ">
                {{ $title }}</button>
            @if (isset($excel))
                <div class="w-3/5 lg:w-2/5">
                    {{$excel}}
                </div>
                <label for="excel"
                    class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold  rounded-full cursor-pointer hidden lg:block">
                    <span class="mx-4 py-2">Importar de Excel</span></label></label>
                <input type="file" name="excel" id="excel" hidden>
            @endif
        </div>



        <dialog id="{!! $modalId !!}" class=" bg-transparent">

            <div
                class="p-7 flex justify-center items-center fixed right-0 left-0 top-0 w-full h-full z-50 transition-opacity duration-300 xl:mx-32   py-4">
                <div class="flex rounded-xl w-max relative draggable cursor-move">
                    <div class="">
                        <div class=" text-white  hover:text-red-400 w-8  h-8 top-3 flex items-center justify-center right-3 bg-gray-900 rounded-full absolute cursor-pointer"
                            onclick="modalClose('{{ $modalId }}')" title="Cerrar">
                            <span class="fas fa-times "></span>
                        </div>


                        <div class="bg-gray-900 bg-opacity-40 px-12 pb-12 pt-8 rounded-xl">
                            <div class="p-7 flex justify-end items-center w-full bg-white  shadow-xl">
                                {{ $slot }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </dialog>



        <script>
            function openModal(key) {
                $('#' + key).show(600);
                $('.overlay').show(400);
            }

            function modalClose(key) {
                $('#' + key).hide(400);
                $('.overlay').hide(600);

            }
            window.addEventListener('load', function() {
                $('#overlay').each(function() {

                    $(this).on('click', function() {
                        console.log('eos')
                    })
                })

            })
            document.onkeydown = function(evt) {
                evt = evt || window.event
                var isEscape = false
                if ("key" in evt) {
                    isEscape = (evt.key === "Escape" || evt.key === "Esc")
                } else {
                    isEscape = (evt.keyCode === 27)
                }
                if (isEscape) {
                    modalClose('{{ $modalId }}');
                }
            };
        </script>

        <style>
            .modal {
                transition: opacity 0.55s ease;
            }

            .modal-active {
                overflow-x: hidden;
                overflow-y: visible !important;
            }

        </style>
    </div>
