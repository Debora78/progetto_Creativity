<table class="table table-striped table-hover">
    <thead class="table-dark">
       <tr>
           <th scope="col">Nome</th>
           <th scope="col">Email</th>
           <th scope="col">Azioni</th>
           <th scope="col">#</th>
        </tr>
        
    </thead>
    <tbody>
        @foreach ($roleRequests as $user)
            
            <tr>
                <th scope="row">{{$user->id}}
                    
                </th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <button class="btn btn-secondary">Attiva{{$role}}</button>
                    </td>
            </tr>
        @endforeach
    </tbody>
  </table>