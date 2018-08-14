<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\ProfileInvesment;
use App\Model\HorizonInvesment;
use App\Model\TypeObjective;
use App\Model\Contract;
use App\Model\Representant;
use App\Model\TypeRepresentant;
use App\Model\Bank;
use App\Model\ClasifCountBank;
use App\Model\AddressRepresentant;
use App\Model\CountBankRepresentant;
use App\Model\TypeDocument;
use App\Model\ExtensionDocument;
use App\Model\DocumentContract;
use App\Model\TransactionContract;
use App\Model\OriginTransaction;
use App\Model\StatusTransaction;
use App\Model\TypeTransaction;
use App\Model\StatusBalance;
use App\Model\Balance;


class AdminInvesmentController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }



  private  $fieldsValidateContract=[
                    'id_profile_invesment' =>'required',
                    'id_horizon_invesment' =>'required',
                    'id_type_objective' =>'required'
                ];

  private $fieldMessageContract=[
            'id_profile_invesment.required'  => 'Selecciona un perfil de inversión.',
            'id_horizon_invesment.required' =>'Selecciona un horizonte de inversión.',
            'id_type_objective.required' =>'Selecciona un objetivo.'
        ];

    public function inicio(Request $request){
    	$query = $request->get("query_search");

    	$users = User::search($query)->sortable()->where( "id_role" ,"!=",User::ROLE_ADMIN  ) ->paginate(10);
      	$request->flashOnly(["query_search"]);
    	return view("admin.invesment",compact('users'));
    }

    public function edit($id){

        $user= User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $catProfile= ProfileInvesment::pluck('name','id')->all();
        $catHorizon=HorizonInvesment::pluck('name','id')->all();
        $catTypeObjective=TypeObjective::pluck('name','id')->all();
        $catTypeReprensentant= TypeRepresentant::pluck('name','id')->all();
        $catBancks= Bank::pluck('name','id')->all();
        $catClasifCountBanck=ClasifCountBank::pluck('name','id') ->all();
        $catTypeDocument = TypeDocument::pluck('name','id')->all();

        return view('admin.invesment_edit',
        compact('user','catProfile','catHorizon','catTypeObjective',
                'catTypeReprensentant' ,'catBancks','catClasifCountBanck',
                'catTypeDocument'));
    }


    public function editContract(Request $request,$id){
        $user =  User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $contrato=$user->contract;
        $request->validate( $this->fieldsValidateContract, $this->fieldMessageContract);
        $data= $request->all();
        if( $contrato == null){
            $user->contract()->save(  new Contract($data) );
        }
        else {
           $contrato->update($data);
        }

        return $this->alertSuccess("La información del contrato fue guardada correctamente.");
    }




    public function editRepresentant(Request $request,$id){
        $user =  User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        //obtenemos el contrato


        $contrato=$user->contract;
        if( $contrato == null ){
          return $this->redirectError("Es necesario crear un contrato para el usuario.");
        }
        $id = $request->get('id');
        $data= $request->all();
        if($id ==null){
          $representant = new Representant( $data );
          $contrato->representants()->save($representant );  //TODO REALIZAR VALIDACION REPRESENTANTE
          $address= new AddressRepresentant(  $data  ); //TODO REALIZAR VALIDACION DIRECCION REPRESENTANTE
          $representant->address()->save( $address );
          return $this->alertSuccess([
          'title' =>'La información del representante fue guardada correctamente.' ,
          'results'=>  [
                          'inputs' =>['id' => $representant->id ,'id_address'=> $address->id  ],
                          'change' => [
                            [
                              'html' => $representant->typeRepresent->name  .' - ' .
                                                 $representant->name .' '. $representant->last_name.' '.
                                                 $representant->last_second_name,
                              'selector' => '.card-header .btn-link',
                              'closest' =>'.tmpl-item'
                            ],
                            [
                              'attr' => ['class'=> 'btn btn-success btn-ajax'  ] ,
                              'html' => 'Editar',
                              'selector' => '.btn-ajax'
                            ],
                              [
                                'attr' => [
                                  'data-id-value' =>  $representant->id
                                ],
                                'selector' => '[data-id-name="id_representant"], [name="id_representant"]',
                                'closest' =>'.tmpl-item'
                              ]

                          ]  ]
                      ]);
        }
        else{
          $id_address = $request->get('id_address');
          $representant = Representant::find($id);
          $address = AddressRepresentant::find( $id_address );
          $representant->update(  $data  );
          $address->update($data);
          return $this->alertSuccess("Modificacion de representante exitosa.");

        }


    }


     public function editCountBank(Request $request,$id){
        $user =  User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $contrato=$user->contract;

        $id_representant= $request->get('id_representant');

        if( $id_representant == null  ){
          return $this->alertError("Debes guardar información del representante para guardar una cuenta bancaria.");
        }
        $representante = $contrato->representants()->find( $id_representant  );
        $id = $request->get("id");
        if( $id ==null){
                $countBank= new CountBankRepresentant($request->all());
                $representante->count_banks()->save($countBank);
                return $this->alertSuccess([
                  'title' => 'Cuenta de banco guardarda exitosamente.',
                  'results' =>[
                    'inputs' =>['id' => $countBank->id   ],
                    'change'=> [
                        'attr' => ['class'=> 'btn btn-success btn-ajax'  ] ,
                        'html' => 'Editar',
                        'selector' => '.btn-ajax'
                      ]
                  ]
                ]);
        }
        else{
              $countBank=  $representante->count_banks()->find($id  );
              $countBank->update( $request->all()  );
              return $this->alertSuccess([
                'title' =>'Cuenta de banco modificada exitosamente.'
              ]);
        }

    }


    public function deleteRepresentant(Request $request){
      $id=$request->get("id");

      if($id == null){
        return $this->alertError("ingresa id de representante.");
      }

      $representant = Representant::find(  $id );
      $address = $representant->address;
      $countsBank = $representant->count_banks;
      foreach($address as $adr){
        $adr->delete();
      }
      foreach($countsBank as $count){
        $count->delete();
      }
      $representant->delete();
      return $this->alertSuccess("Se elimino el registro de representante correctamente.");
    }

    public function deleteCountBank(Request $request) {

      $id=$request->get("id");
      if($id == null){
        return $this->alertError("ingresa id  de cuenta.");
      }
        $countBank = CountBankRepresentant::find(  $id );
        $countBank->delete();
        return $this->alertSuccess("Se elimino el registro de cuenta de banco correctamente.");

    }


    public function editDocument(Request $request, $id ){

      $user =  User::find($id);
      if( $user == null ){
          return $this->alertWarning(['title' => 'No fue posible encontrar usuario.','isAjax' =>true] );
      }
      $contrato = $user->contract;
      if($contrato == null){
          return $this->alertError( ['title' => "Debes crear un contrato para guardar documento.", 'isAjax' =>true]);
      }
      if ($request->file('file')->isValid()) {
        $file = $request->file;
        $extension =$file->extension();
        $catExtension= ExtensionDocument::pluck('id','extension')->all();

        if( !isset( $catExtension[ $extension ])){
          return $this->alertError(["title"=> "Extensión de archivo no permitido." ,'isAjax' =>true ]);
        }

        $id_extension = $catExtension[ $extension ];
        $name= $file->getClientOriginalName();
        $content = $file->openFile()->fread($file->getSize());
        $id_type_document= $request->get("id_type_document");
        $id_contract= $contrato->id;
        $id = $request->get('id');
        $count= $request->get('count');
        $data= compact('id_contract','name','content','id_type_document','id_extension') ;
        if( $id ==null   ){
          $documento=  new DocumentContract( $data );
        }
        else {
          $documento = $contrato->documents()->find($id );
          $documento->fill($data);
        }
        $documento->save($data);
          $msg= $id ==null ? "Documento Guardado Correctamente." : "Documento modificado correctamente";
          $results = $id ==null ?  [
                'change' => [
                    'html' =>  view("elements.admin.invesment_edit_form_document_tmpl",
                                [
                                'user'=> $user,
                                'contrato' =>$contrato,
                                'count' =>$count,
                                'catTypeDocument' => TypeDocument::pluck('name','id')->all(),
                                'type' => 'edit' ,
                                'documento' => $documento] )->render(),
                    'closest' =>'.tmpl-item'

                    ]
              ] :null;
        return $this->alertSuccess( ['title' => $msg  , 'results' =>  $results  ,'isAjax' =>true] );
      }


    }
    public function viewDocument($id){
        if($id == null){
          return $this->alertError("No existe el documento.","admin.users");
        }
        $documento= DocumentContract::find($id);

        if($documento== null){
          return $this->alertError("Documento no encontrado.","admin.users");
        }

      //  $file_contents = base64_decode($documento->content);
        return response($documento->content)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Viewer')
            ->header('Content-Type', $documento->extension->name)
            ->header('Content-length', strlen($documento->content))
            ->header('Content-Disposition' , 'inline; filename="'.$documento->name.'"');
    }

    public function downloadDocument($id){
      if($id == null){
        return $this->alertError("No existe el documento.","admin.users");
      }
      $documento= DocumentContract::find($id);

      if($documento== null){
        return $this->alertError("Documento no encontrado.","admin.users");
      }
      //  $file_contents = base64_decode($documento->content);
        return response($documento->content)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Viewer')
            ->header('Content-Type', $documento->extension->name)
            ->header('Content-length', strlen($documento->content))
            ->header('Content-Disposition', 'attachment; filename=' . $documento->name)
            ->header('Content-Transfer-Encoding', 'binary');

    }

    public function deleteDocument(Request $request){

      $id=$request->get("id");
      if($id == null){
        return $this->alertError("ingresa id  de documento.");
      }
        $countBank = DocumentContract::find(  $id );
        $countBank->delete();
        return $this->alertSuccess("Se elimino el registro de documento correctamente.");
    }

    public function balances( $id){

      $user= User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }

      $catOriginTrans= OriginTransaction::pluck('name','id')->all();
      $catTypeTrans=TypeTransaction::pluck('name','id') ->all();
      $catStatusTrans = StatusTransaction::pluck('name','id')->all();
      $catStatusBalance= StatusBalance::pluck('name','id')->all();

      return view("admin.invesment_balances",compact('user','catOriginTrans','catTypeTrans','catStatusTrans',
      'catStatusBalance'));
    }


    public function editTransaction(Request $request,$id){
      $user =  User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }
      $contrato=$user->contract;

      if($contrato == null){
          return $this->alertError( ['title' => "Debes crear un contrato para generar una transacción.",]);
      }
      $id = $request->get('id');
      $transaccion= $id===null ?   new  TransactionContract($request->all()  ) : TransactionContract::find($id) ;

      if( $id == null){
        $contrato->transactions()->save( $transaccion  );
      }else{
        $transaccion->fill($request->all());
        $transaccion->save();
      }
      $count= $request->get('count');
      $title= $id===null ?'Transaccion guardada exitosamente.' :'Transaccion editada correctamente';
      return $this->alertSuccess([
        'title' =>  $title,
        'results' =>[
          'change'=> [
            'html' =>  view("elements.admin.invesment_edit_form_trans_tmpl",
                        [
                          'user'=> $user,
                          'contrato' =>$contrato,
                          'count' =>$count,
                          'catOriginTrans' => OriginTransaction::pluck('name','id')->all(),
                          'catTypeTrans' => TypeTransaction::pluck('name','id') ->all(),
                          'catStatusTrans' => StatusTransaction::pluck('name','id')->all(),
                          'type' => 'edit' ,
                          'transaccion' => $transaccion
                        ]
                        )->render(),
            'closest' =>'.tmpl-item'
            ]
        ]
      ]);

    }
    public function deleteTransaction(Request $request,$id=null){
      $id= $id==null ?  $request->get("id"):$id;
      if($id == null){
        return $this->alertError("ingresa id  de transacción.");
      }
      $transaccion = TransactionContract::find(  $id );
      $transaccion->delete();
      return $this->alertSuccess("Se elimino el registro de documento correctamente.");
    }

    //***  Balance Diario  ** */

    public function editBalance(Request $request,$id){
      $user =  User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }
      $contrato=$user->contract;

      if($contrato == null){
          return $this->alertError( ['title' => "Debes crear un contrato para generar un balance.",]);
      }
      $id = $request->get('id');
      $transaccion= $id===null ?   new  Balance($request->all()  ) : Balance::find($id) ;

      if( $id == null){
        $contrato->balances()->save( $transaccion  );
      }else{
        $transaccion->fill($request->all());
        $transaccion->save();
      }

      $title= $id===null ?'Balance guardada exitosamente.' :'Balance editada correctamente';
      return $this->alertSuccess([
        'title' =>  $title,
        'results' =>[
          'inputs' =>['id' => $transaccion->id   ],
          'change'=> [
              'attr' => ['class'=> 'btn btn-success btn-ajax'  ] ,
              'html' => 'Editar',
              'selector' => '.btn-ajax'
            ]
        ]
      ]);
    }

    public function deleteBalance(Request $request,$id=null){
      $id= $id==null ?  $request->get("id"):$id;
      if($id == null){
        return $this->alertError("ingresa id  de Balance.");
      }
      $balance = Balance::find(  $id );
      $balance->delete();
      return $this->alertSuccess("Se elimino el registro de balance correctamente.");
    }


    public function calcularTotalDepositos($id){
      $user =  User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }
      $contrato=$user->contract;

      if($contrato == null){
          return $this->alertError( ['title' => "Debes crear un contrato para calcular depositos.",]);
      }

      $sum=TransactionContract::where(
          [ 'id_contract' => $contrato->id  ,
            'id_type_transaction' => 1,
            'id_status_transaction' => 2 ])->sum('amount');

      return response()->json( (float)  $sum  );
    }


    public function calcularTotalRetiros($id){
      $user =  User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }
      $contrato=$user->contract;
      if($contrato == null){
          return $this->alertError( ['title' => "Debes crear un contrato para calcular retiros.",]);
      }

      $sum=TransactionContract::where([
          'id_contract' => $contrato->id  ,
          'id_type_transaction' => 2,
          'id_status_transaction' => 2    ])->sum('amount');

      return response()->json( (float)  $sum  );

  }







}
