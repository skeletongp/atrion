
- [1. INTRODUCCIÓN](#1-introducción)
    - [1.0.1. Funciones](#101-funciones)
    - [1.0.2. Funciones CRUD](#102-funciones-crud)
      - [1.0.2.1. Crear](#1021-crear)
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
<p align="justify">En esta porción de código declaramos las variables a utilizar dentro del componente, tales como los campos que vamos a guargar.
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

