<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emergencia;
use App\Clave;
use App\Cia;
use App\EmergenciaCia;
use App\Vehiculo;
use App\EmergenciaUnidad;
use App\ParteOnline;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Pdf;
class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencia = Emergencia::orderBy('id','DESC')->paginate(10);
        
        return view('emergencia.index')->with('eme',$emergencia);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clave=Clave::pluck('clave','id');
        $cia=Cia::pluck('nombre','id');
        $veh = Vehiculo::where('estado','A')->get();
        return view('emergencia.create')->with('clave',$clave)
                ->with('cia',$cia)->with('veh',$veh);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eme = new Emergencia($request->all());
        $eme->usuario_id=Auth::user()->id;
        $eme->save();

        foreach ($request->cias as  $row) {
            $eme_cia = new EmergenciaCia();
            $eme_cia->emergencia_id=$eme->id;
            $eme_cia->cia_id=$row;
            $eme_cia->save();
        }

        foreach ($request->uni as  $row) {
            $uni_cia = new EmergenciaUnidad();
            $uni_cia->emergencia_id=$eme->id;
            $uni_cia->vehiculo_id=$row;
            $uni_cia->save();
        }
        
        session()->flash('info', 'Emergencia creada Correctamente');

        return redirect()->route('emergencia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eme = Emergencia::find($id);
        $cia=Cia::pluck('nombre','id');
        $veh = Vehiculo::where('estado','A')->get();
        $parte = ParteOnline::where('emergencia_id',$id)->where('estado','T')->get();
        $clave=Clave::pluck('clave','id');
        return view ('emergencia.edit')->with('eme',$eme)
                    ->with('cia',$cia)->with('veh',$veh)
                    ->with('clave',$clave)->with('parte',$parte);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eme = Emergencia::find($id);
        $eme->fill($request->all());
        $eme->save();

        EmergenciaCia::where('emergencia_id',$id)->delete();
        foreach ($request->cias as  $row) {
            $eme_cia = new EmergenciaCia();
            $eme_cia->emergencia_id=$eme->id;
            $eme_cia->cia_id=$row;
            $eme_cia->save();
        }
        EmergenciaUnidad::where('emergencia_id',$id)->delete();
        foreach ($request->uni as  $row) {
            $uni_cia = new EmergenciaUnidad();
            $uni_cia->emergencia_id=$eme->id;
            $uni_cia->vehiculo_id=$row;
            $uni_cia->save();
        }

        session()->flash('info', 'Emergencia Modificada Correctamente');

        return redirect()->route('emergencia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showEmergencia(Request $request){

        $clave = Clave::orderBy('id','ASC')->get();
        if($request->q!=""){
            
            foreach ($clave as $key => $row) {
                $e = Emergencia::where('clave_id',$row->id)->whereYear('created_at',$request->q)->count();
                $clave[$key]->cantidad = $e;
            }
        }
         return view('emergencia.show')->with('clave',$clave);
    }

    public function partePDF($id){
        $parte = ParteOnline::find($id);
        $emergencia = Emergencia::find($parte->emergencia_id);
       
        /*
        function Header() {
            $this->SetFont('Arial','B',14)
            //Movimiento hacia la derecha 'Informe de Servicio'
            $this->Image(asset('img/logo_pdf.jpg'), 10, 10, 20)
            $this->Image(asset('img/logo_pdf.jpg'), 190, 10, 20)
            $this->Image(asset('img/marcadeagua.png'), 40, 80, 130, 150)
            $this->SetXY(35,15)
            $this->Cell(150, 7, 'Informe de Servicio Cuerpo de Bomberos de Iquique', 1, 2, 'C')
            $this->Ln(13)
        }

        function Footer() {
            $this->SetY(-14);
            $this->SetFont('Arial','B',8);
            $this->Cell(0,10,utf8_decode('Cuerpo Bomberos de Iquique - Página ').$this->PageNo(),0,0,'C');
        }
         */
        $cia="";
        $a="";
        foreach($emergencia->cias as $cias){
         $cia=$cia.$cias->cia->numero.'-';
        }

        $a=rtrim($cia,'-');

        $uni="";
        $b="";
        foreach($emergencia->unidades as $unis){
         $uni=$uni.$unis->vehiculo->clave.'-';
        }

        $b=rtrim($uni,'-');  
    
    $pdf=new Pdf('P','mm','letter');
    $pdf->AddPage();
    $pdf->Line(10, 50, 205, 50);
    $pdf->Line(10, 50, 10, 200);
    $pdf->Line(10, 200, 205, 200);
    $pdf->Line(205, 200, 205, 50);
    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Nº Informe :"), 0, 0, 'L');
    $pdf->SetXY(60,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(20, 0, utf8_decode($parte->numero), 0, 0, 'C');
    $pdf->SetXY(83,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Compañia :"), 0, 0, 'L');
    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->cia->nombreCompleto()), 0, 0, 'L');
    $pdf->SetXY(10,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Fecha/Hora Envio :"), 0, 0, 'L');
    $pdf->SetXY(50,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(45, 0, utf8_decode($parte->created_at), 0,0, 'L');
    $pdf->SetXY(95,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Responsable :"), 0, 0, 'L'); 
    $pdf->SetXY(125,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->responsable->rol.' '.$parte->responsable->nombreSimple()), 0,0, 'L');
    $pdf->Line(10, 60, 60, 60);
    $pdf->Line(60, 60, 60, 50);
    $pdf->SetXY(12,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DATOS INFORME"), 0, 0, 'L');
    $pdf->SetXY(65,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("CLAVE EMERGENCIA :"), 0, 0, 'L');
    $pdf->SetXY(115,55);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(15,0, utf8_decode($emergencia->clave->clave), 0, 0, 'C');
    $pdf->Line(112, 57, 140,57);
    $pdf->SetXY(141,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("FECHA :"), 0, 0, 'L');
    $pdf->SetXY(160,55);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(35,0, utf8_decode(date('d-m-Y',strtotime($emergencia->fecha_emergencia))), 0, 0, 'C');
    $pdf->Line(158, 57, 200,57);
    $pdf->SetXY(12,70);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("HORA EMERGENCIA :"), 0, 0, 'L');
    $pdf->SetXY(57,70);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(20,0, utf8_decode($emergencia->hora_emergencia), 0, 0, 'C');
    $pdf->Line(57,72,83,72);
    $pdf->SetXY(85,70);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("CIAS ASISTENTES :"), 0, 0, 'L');
    $pdf->SetXY(126,70);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(75,0, utf8_decode($a), 0, 0, 'C');
    $pdf->Line(125,72, 200,72);
    $pdf->SetXY(12,80);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("UNIDADES ASISTENTES :"), 0, 0, 'L');
    $pdf->SetXY(66,80);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(134,0, utf8_decode($b), 0, 0, 'C');
    $pdf->Line(65,82, 200,82);
    $pdf->Line(10,85, 205,85);//separador 
    $pdf->Line(10,95, 60,95);
    $pdf->Line(60,95, 60,85);
    $pdf->SetXY(12,90);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DIRECCION INFORME"), 0, 0, 'L');
    $pdf->SetXY(84,90);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("COMUNA :"), 0, 0, 'L');
    $pdf->SetXY(108,90);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(40,0, utf8_decode($emergencia->comuna), 0, 0, 'C');
    $pdf->Line(106,92, 150,92);
    $pdf->SetXY(12,105);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DIRECCION :"), 0, 0, 'L');
    $pdf->SetXY(40,105);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(125,0, utf8_decode($emergencia->direccion), 0, 0, 'L');
    $pdf->Line(38,107, 200,107);
    $pdf->SetXY(12,115);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("ANEXO :"), 0, 0, 'L');
    $pdf->SetXY(40,113);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(125,0, utf8_decode($parte->anexo_direccion), 0, 0, 'L');
    $pdf->Line(38,115, 200,115);
    $pdf->Cell(20,0, utf8_decode(''), 0, 0, 'C');
    $pdf->Line(10,127, 205,127);//SEPARADOR
    $pdf->Line(10,137, 60,137);
    $pdf->Line(60,137, 60,127);
    $pdf->Line(120,127, 120,200);//VERTICAL
    $pdf->SetXY(12,132);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("AFECTADO"), 0, 0, 'L');
    $pdf->SetXY(12,145);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("RUT :"), 0, 0, 'L');
    $pdf->SetXY(24,145);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(37,0, utf8_decode($parte->run_afectado), 0, 0, 'L');
    $pdf->Line(23,147, 50,147);
    $pdf->SetXY(12,155);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("NOMBRE :"), 0, 0, 'L');
    $pdf->SetXY(35,155);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(75,0, strtoupper(utf8_decode($parte->afectado)), 0, 0, 'L');
    $pdf->Line(33,157, 110,157);
    $pdf->SetXY(12,165);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("RELACION :"), 0, 0, 'L');
    $pdf->SetXY(38,165);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(55,0, utf8_decode($parte->relacion), 0, 0, 'L');
    $pdf->Line(37,167, 110,167);
    $pdf->SetXY(12,175);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("SEGURO :"), 0, 0, 'L');
    $pdf->SetXY(35,175);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(75,0, utf8_decode($parte->seguro), 0, 0, 'L');
    $pdf->Line(33,177, 110,177);
    $pdf->Line(120,137, 140,137);
    $pdf->Line(140,137, 140,127);
    $pdf->SetXY(122,132);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("OBAC"), 0, 0, 'L');
    $pdf->SetXY(122,145);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("OBAC CIA "), 0, 0, 'C');
    $pdf->SetXY(123,155);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(75,0, utf8_decode($parte->obacCia->rol.' '.$parte->obacCia->nombreSimple()), 0, 0, 'C');    
    $pdf->Line(122,157, 200,157);
    $pdf->SetXY(123,165);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("OBAC CBI "), 0, 0, 'C');
    $pdf->SetXY(123,175);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(75,0, utf8_decode($parte->obacCbi->rol.' '.$parte->obacCbi->nombreSimple()), 0, 0, 'C');
    $pdf->Line(122,177, 200,177);
    $pdf->Line(10,200, 10,250);
    $pdf->Line(10,250, 205,250);
    $pdf->Line(205,250, 205,200);
    $pdf->SetXY(12,205);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DATOS SOLO RESCATE"), 0, 0, 'L');
    $pdf->Line(10,210, 65,210);
    $pdf->Line(65,210, 65,200);
    $pdf->SetXY(12,220);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("OP. DE RESCATE :"), 0, 0, 'L');
    $pdf->Line(50,222, 65,222);
    $pdf->SetXY(52,220);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,0, utf8_decode($parte->op_rescate), 0, 0, 'L');
    $pdf->SetXY(80,220);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("CANT. VEH. :"), 0, 0, 'L');
    $pdf->Line(106,222, 120,222);

    $pdf->SetXY(108,220);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,0, utf8_decode($parte->vehiculos), 0, 0, 'L');


    $pdf->SetXY(130,220);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("LESIONADOS:"), 0, 0, 'L');
    $pdf->Line(159,222, 173,222);

    $pdf->SetXY(161,220);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,0, utf8_decode($parte->lesionados), 0, 0, 'L');
/*********************************  SEGUNDA PAGINA  *************************************************/
    $pdf->AddPage(); 
    $pdf->Line(10, 50, 205, 50);
    $pdf->Line(10, 50, 10, 250);
    $pdf->Line(10, 250, 205, 250);
    $pdf->Line(205, 250, 205, 50);
    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Nº Informe :"), 0, 0, 'L');
    $pdf->SetXY(60,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(20, 0, utf8_decode($parte->numero), 0, 0, 'C');
    $pdf->SetXY(83,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Compañia :"), 0, 0, 'L');
    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->cia->nombreCompleto()), 0, 0, 'L');
    $pdf->SetXY(10,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Fecha/Hora Envio :"), 0, 0, 'L');
    $pdf->SetXY(50,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(45, 0, utf8_decode($parte->created_at), 0,0, 'L');
    $pdf->SetXY(95,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Responsable :"), 0, 0, 'L'); 
    $pdf->SetXY(125,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->responsable->rol.' '.$parte->responsable->nombreSimple()), 0,0, 'L');
    $pdf->Line(10, 60, 205, 60);
    $pdf->Line(40, 60, 40, 50);
    $pdf->SetXY(12,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("CAUSA"), 0, 0, 'L');     
    $pdf->SetXY(45,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("LUGAR AMAGADO:"), 0, 0, 'L');

    $pdf->SetXY(90,55);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0,0, utf8_decode($parte->tipo), 0, 0, 'L'); 


    $pdf->Line(10, 110, 205, 110);//SEPARADOR
    $pdf->SetXY(12,62);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0,5,utf8_decode($parte->causa), 0, 1);
    $pdf->SetXY(12,115);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("ORIGEN"), 0, 0, 'L');
    $pdf->Line(10, 119, 40, 119);
    $pdf->Line(40, 119, 40, 110);
    $pdf->SetXY(12,121);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(85,5,utf8_decode($parte->origen), 0, 1);
    $pdf->SetXY(102,115);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DAÑO"), 0, 0, 'L');
    $pdf->Line(100, 119, 120, 119);
    $pdf->Line(120, 119, 120, 110);
    $pdf->Line(100, 110, 100,150);
    $pdf->Line(10, 150, 205,150);
    $pdf->SetXY(102,121);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(100,5,utf8_decode($parte->danio), 0, 1);
    $pdf->SetXY(12,154);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("DETALLES"), 0, 0, 'L');
    $pdf->Line(10, 158, 40,158);
    $pdf->Line(40, 158, 40,150);
    $pdf->SetXY(12,160);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0,5,utf8_decode($parte->info), 0, 1); 
    $pdf->Line(10, 200, 205,200);//SEPARADOR
    $pdf->SetXY(12,204);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("TRABAJO REALIZADO"), 0, 0, 'L');
    $pdf->Line(10, 208, 65,208);
    $pdf->Line(65, 208, 65,200);
    $pdf->SetXY(12,210);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0,5,utf8_decode($parte->trabajo), 0, 1);
/*******************************  TERCERA PAGINA ASISTENCIA  *************************************************/
    $pdf->AddPage(); 
    $pdf->Line(10, 50, 205, 50);
    $pdf->Line(10, 50, 10, 250);
    $pdf->Line(10, 250, 205, 250);
    $pdf->Line(205, 250, 205, 50);
    $pdf->Line(102, 50, 102, 250);
    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Nº Informe :"), 0, 0, 'L');
    $pdf->SetXY(60,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(20, 0, utf8_decode($parte->numero), 0, 0, 'C');
    $pdf->SetXY(83,35);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 0, utf8_decode("Compañia :"), 0, 0, 'L');
    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->cia->nombreCompleto()), 0, 0, 'L');
    $pdf->SetXY(10,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Fecha/Hora Envio :"), 0, 0, 'L');
    $pdf->SetXY(50,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(45, 0, utf8_decode($parte->created_at), 0,0, 'L');
    $pdf->SetXY(95,44);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0,0, utf8_decode("Responsable :"), 0, 0, 'L'); 
    $pdf->SetXY(125,44);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 0, utf8_decode($parte->responsable->rol.' '.$parte->responsable->nombreSimple()), 0,0, 'L');
    $pdf->SetXY(12,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(88,0, utf8_decode("NOMINA VOLUNTARIOS ASISTIDO"), 0, 0, 'C');
    
    $ind=58;
    $X=12;
    foreach ($parte->asistencias as $row) {
        $ind=$ind+6;
                if($ind>=245){
                $X=105;
                $ind=64;
                }
                $pdf->SetXY($X,$ind);
                $pdf->SetFont('Arial', '', 12);  
                $pdf->Cell(88,0,utf8_decode($row->usuario->rol." - ".$row->usuario->nombreSimple()), 0, 0,'L');
    }  
    $pdf->SetXY(105,55);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(90,0, utf8_decode("NOMINA VOLUNTARIOS ASISTIDO"), 0, 0, 'C');
    $ind=58;
                
    $pdf->Output("PARTEONLINE.pdf","D");
    }



}
