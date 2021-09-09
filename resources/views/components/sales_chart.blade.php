<div >
     <!-- Chart's container -->
 <div id="chart"  class="mt-1 mx-auto" style="height: 25rem; width:25rem; margin:auto"></div>
 <!-- Charting library -->
 <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
 <!-- Chartisan -->
 <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
 <!-- Your application script -->
 @push('js')
 <script>
    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sales_chart')",
        hooks: new ChartisanHooks()
            .axis(false)
            .colors(['#EA094B', '#4200E1', '#00AAEF', '#CCAAEF', '#FFACEE', '#CCFE00', '#00EFCA'])
            .tooltip()
            
            .title('Ingresos por día')
            .datasets([{
                    type: 'pie',
                    radius: ['40%', '60%']
                },
                
            ]),
    });
</script>
<style>
    
</style>
 @endpush

</div>