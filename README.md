<body style=" width:600px; margin:auto; background-color:#222; color:#fff ">

- [1. INTRODUCCIÓN](#1-introducción)
    - [1.0.1. Funciones](#101-funciones)
    - [1.0.2. Funciones CRUD](#102-funciones-crud)
      - [1.0.2.1. Crear](#1021-crear)
      - [1.0.2.2. Leer](#1022-leer)
# 1. INTRODUCCIÓN

<p align="justify">
Atrion es un sistema de facturación pensado para negocios que tienen varias sucursales y que deben ser gestionados desde un mismo software integrado, contando con una base de datos central donde se registran las informaciones concercientes a todas las entidades del sistema, entre ellas: <b>usuarios</b> , <b>clientes</b>, <b>productos</b>, <b>sucursales</b>, <b>informaciones financieras</b> y demás.
</p>

### 1.0.1. Funciones
<p align="justify">
<b> <u>Facturación </u></b>: Generar facturas y cotizaciones, consultar facturas y cotizaciones, manejar las informaciones relacionadas a la facturación de los productos, tales como: disponibilidad, precios, cantidad y demás.
</p>

<p align="justify">
<b> <u>Clientes </u></b>: Dar mantenimiento al registro de cliente, lo que incluye: añadir nuevos clientes, dar de baja a los clientes (softdelete), editar informaciones de los clientes, consultar datos relevantes, relacionar con otras entidades y aplicar análisis de datos para CRM.
</p>

<p align="justify">
<b> <u>Inventario </u></b>: Gestionar el inventario de productos, con funciones para dar a entrada, modificar la existencia en stock, relacionar con proveedores, dar de baja, consultar disponibilidad, gestionar precios y demás. Permite la relación de productos con otras entidades del sistema.
</p>

<p align="justify">
<b> <u>Proveedor </u></b>: Gestionar la entidad homómina, permitiendo darle mantenimiento en cuanto a: ingresar nuevo registro, actualizar datos de los registros existentes, dar de baja a los proveedores (softdelete), consultar los datos registrados y relacionarlos con otras entidades, tales como: productos y cuentas por pagar.
</p>

<p align="justify">
<b> <u>Ingresos </u></b>: Gestionar la entidad homómina, permitiendo darle mantenimiento en cuanto a: ingresar nuevo registro, actualizar datos de los registros existentes, dar de baja a los proveedores (softdelete), consultar los datos registrados y relacionarlos con otras entidades, tales como: productos y cuentas por pagar.
</p>

### 1.0.2. Funciones CRUD
<p align="justify">
<b> <u>Descripción </u></b>: Para cada una de las funciones crud de los modelos, se utilizan los mismos estándares, de modo que lo único que cambia son los campos a intervenir y, en el caso de algunos modelos, ciertas variables en la edicación que serán explicadas en su momento.
</p>

<p align="justify">

#### 1.0.2.1. Crear

<b> <u>Crear Registro </u></b>: Para la creaciónd de nuevos registros, se utiliza un componente Livewire, con su correspondiente clase de PHP. El Blade del componente contiene la vista con el formulario de los campos a enviar, los botones correspondientes y demás. Dicho formulario es enviado a la vista correspondiente del modelo mediante el componente de blade llamado <b style="color:yellow; font-size:medium">Modal</b>, el cual recibe como principal slot la instancia del componente "add-<i>modelo</i>".

Por ejemplo, en el caso de los productos, se utilizará el siguiente formato:
~~~
public $name, $meta, $category_id=1, $place_id, $stock, $price, $cost, $is_product, $code;
    public $message;
    protected $listeners=['update_add_product'=>'render', 'store_product'=>'store'];
~~~
</p>
<p align="justify">En esta porción de código declaramos las variables a utilizar dentro del componente, tales como los campos que vamos a guardar.
También se declaran los <i style="color:yellow">listeners</i> para los eventos correspondientes. Luego de esto, declaramos las reglas de validaciones:

~~~
 protected $rules=[
        'name'=>'required|unique_with:products,place_id|max:40',
        'meta'=>'required|max:100',
        'category_id'=>'required',
        'place_id'=>'required',
        'stock'=>'required|min:0|numeric',
        'price'=>'required|min:0|numeric',
        'cost'=>'required|min:0|numeric',
    ];
~~~
</p>
<p align="justify"> El siguiente paso es declarar el método <i style="color:yellow">render</i>, donde cargamos los datos iniciales necesarios para el componente. Dicho método suele tener la siguiente forma:

~~~
 public function render()
    {
        if ($this->is_product==null) {
            $this->is_product=1;
        }
        $places=Place::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        return view('livewire.add-product', compact('places', 'categories'));
    }
~~~
</p>
<p align="justify"> En el método <i style="color:yellow">store</i>, se realiza la validación, creamos una instancia del modelo con el que estamos trabajando, le pasamos los valores de cada campo correspondiente y guardamos. También reseteamos las variables a su valor inicial. Al guardar, es importante ejecutar el método <i style="color:yellow">$this->emit('update_model_table')</i>, el cual es escuchado por la clase que corresponde a la vista del modelo, la cual se renderiza con el nuevo registro:

~~~
 $this->validate();
        $product= new Product();
        $product->name=$this->name;
        $product->code=$this->code;
        $product->meta=$this->meta;
        $product->category_id=$this->category_id;
        $product->place_id=$this->place_id;
        $product->stock=$this->stock;
        $product->price=$this->price;
        $product->cost=$this->cost;
        $product->is_product=$this->is_product;
        $product->slug=Str::slug($this->name);
        $product->save();
        $this->reset('name','meta','category_id','place_id','stock','price','cost');
        $this->emit('update_product_table');
~~~
</p>
<p align="justify"> Después de esto añadimos métodos adicionales necesarios para funcionalidades específicas de cada modelo, como el de selección múltiple que se usa en el caso de los proveedores y los usuarios:
</p>

#### 1.0.2.2. Leer

<p align="justify"> Cada modelo o entidad del proyecto se lista en una vista blade mediante una tabla, con excepción de las sucursales, que se muestran en un Grid. Para eso, utilizamos un componente livewire, cuyo esquema de nombre es <i style="color:yellow">modelo-table</i>, con su correspondiente clase en PHP.

Al principio de la clase de cada vista se incluyen las declaraciones necesarias para su funcionamiento, incluyendo el <i style="color:yellow">use Pagination</i>, para poder paginar los registros. El esquema de dichas declaraciones es:

~~~
 public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up'; 
 //Campos para ordenar los registros

    public $is_active = 1, $title = 'Usuarios activos', $icon = "fa-trash text-red-500", 
    $confirm = '¿Eliminar usuario?', $button = 'fa-recycle';
    //Campos que varían al abrir papelera.

    protected $listeners = ['update_provider_table' => 'render']; 
    // Escucha el evento que se envía desde el componente add-model y renderiza la vista.
~~~

</p>
<p align="justify"> El método <i style="color:yellow">render</i> es el encargado de cargar la vista con la lista de registros pertinentes, buscando los registros en el modelo según si se trata de los datos activos o de la papelera, usando la variable <i style="color:yellow">$is_active</i>  para controlar esto.:

~~~
  public function render()
    {
        if ($this->is_active == 1) {
            $providers = Provider::search($this->search)
                
                ->orderBy($this->order, $this->direction)->paginate(10);
        } else {
            $providers = Provider::onlyTrashed()->search($this->search)
               
                ->orderBy($this->order, $this->direction)->paginate(10);
        }
        return view('livewire.provider-table')->with(['providers'=>$providers]);
    }
~~~
El método <i style="color:yellow">search()</i> corresponde al paquete <i style="color:yellow">Nicolaslopezj\Searchable\SearchableTrait;</i>, instalado mediante Composer y que permite hacer una búsqueda profunda en el modelo y sus relaciones.
</p>

<p align="justify"> El método <i style="color:yellow">toggle</i>, es utilizado en cada vista para alternar entre la lista de registros activos y los que han sido borrados por medio del <i style="color:yellow">softdelete</i>. Dicho método actualiza el título de la vista, el ícono al lado de cada registro, el texto del botón confirmar y el ícono del botón que lo ejecuta:

~~~
public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Usuarios eliminados';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar producto?';
            $this->button = 'fa-reply-all';
        } else {
            $this->reset('is_active', 'title', 'icon', 'confirm', 'button');
        }
        $this->resetPage(); //Refresca la paginación
    }
~~~

</p>

<p align="justify"> El método <i style="color:yellow">sofdelete</i>, que se encuentra en las vistas de modelos, sirve para inhabilitar si lo llamamos desde un registro activo, o para restaurar, si lo llamadamos desde un registro en papelera:

~~~
  public function softdelete($provider)
    {
        $provider=Provider::withTrashed()->where('slug','=',$provider)->first();

        if($provider->deleted_at==null){
            $provider->delete();
        } else{
            $provider->restore();
        }
        $this->render();
    }

    /* Realiza la búsqueda en el modelo
    Se llamada desde el icono de la lupa al lado del
    input texto o con el evento search del mismo */

    public function search()
    {
        $this->render();
    }
~~~

</p>
<p align="justify"> El método <i style="color:yellow">order</i>, ordena los datos en la tabla de la vista, por campo y según cada dirección. También cambia los iconos correspondientes.:

~~~
   public function order($order)
    {
        $this->order = $order;
        if ($this->direction == 'asc') {
            $this->direction = "desc";
            $this->icon_order='fa-sort-down';
        } else {
            $this->direction = "asc";
            $this->icon_order='fa-sort-up';

        }
        $this->resetPage(); //Refresca la paginación
    }
~~~

</p>




</body>