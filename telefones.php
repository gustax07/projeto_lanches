<?php
session_start();
$idUsuario = $_SESSION['usuario']['id'];

if (!isset($_SESSION['usuario'])) {
  header('Location: logar.php');
  exit;
}
include_once("classes/telefones.class.php");
$telefones = new Telefones();

$telefones->id_usuarios_fk = $idUsuario;
$listar = $telefones->ListarPorID();
$qtdTelefones = count($listar);

include_once("header.php");
include_once("includes/bootstrap_include.php");
include_once("includes/sweet_alert2_include.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Telefones</title>
  <style>
    .card {
      margin: auto;
      width: 23vw;
      margin-bottom: 10px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      color: #333;

    }

    @media (max-width: 768px) {
      .card {
        width: 90%;
      }
    }

    .card-body {
      display: flex;
      align-items: center;

    }

    h2 {
      text-align: center;
      margin-top: 30px;
      margin-bottom: 30px;
    }

    .card input {
      margin: 5px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f2f2f2;
      color: #333;
      font-size: 16px;
    }

    .card select:disabled,
    input:disabled {
      color: rgba(165, 165, 165, 1) !important;
    }

    .btnn {
      
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    .btn-lg {
      background-color: #ffffff00 !important;
      border: none !important;
      font-size: larger !important;
    }

    select {
      margin: 5px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f2f2f2;
      color: #333;
      font-size: 16px;
    }
    .card-footerr{
      display: flex;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <h2>Lista de Telefones registrados</h2>


  <!-- sessao de adicionar telefones -->
  <div class="card">
    <div class="card-body">
      <div id="form-telefones"></div>
    </div>
    <hr>
    <div class="card-footerr">
      <button type="button" class="btnn" onclick="AdicionarNovosTelefones(<?= $qtdTelefones ?>)" id="criar"><i class="bi bi-plus-circle"></i> Adicionar Telefones</button>
      <button type="button" class="btnn" onclick="CadastrarTelefone(<?= $qtdTelefones ?>)" style="background-color:#007bff"><i class="bi bi-save"></i> Salvar</button>
    </div>
  </div>
  <script>
    var el = document.getElementById("form-telefones")

    var qtdTelefones = <?php echo json_encode($listar) ?>;

    let ids = qtdTelefones.length + 1;

    let listaPaises = [];

    async function Render(id, numero, ddi, read, edit) {
      const readonly = read ? "disabled" : "";
      const edits = edit ? '' : "hidden";

      const response = await fetch('https://api-paises.pages.dev/paises.json');
      const data = await response.json();

      listaPaises = Object.values(data);

      let htmll = "";

      listaPaises.sort(function(a, b) {
        return a.ddi - b.ddi
      })
      listaPaises.forEach(p => {
        htmll += `<option value="${p.ddi}" ${ddi == p.ddi ? "selected" : ""}>+${p.ddi}</option>`;

      });

      const nameTelefone = read ? '' : `name="telefone${id}"`;
      const nameDdi = read ? '' : `name="ddi${id}"`;

      const html = `
      <div class="form-group" id="grupo${id}">
          <select id="ddi${id}" ${nameDdi} ${readonly}>
            ${htmll}
          </select>
        <input type="text" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" id="telefone${id}" ${nameTelefone} value="${numero}" ${readonly}>
        <button class="btn-lg" type="button" onclick="DeletarTelefone(${id})"><i class="bi bi-trash"></i></button>
        <button class="btn-lg" type="button" ${edits} id="editar${id}" onclick="EditarTelefone(${id})"><i class="bi bi-pencil"></i></button>
        <button class="btn-lg" type="button" ${edits} id="salvar${id}" onclick="SalvarTelefone(${id})"hidden><i class="bi bi-check-lg"></i></button>
      </div>
  `

      el.insertAdjacentHTML("beforeend", html);
      if (document.querySelectorAll(".form-group").length >= 4) {
        document.getElementById("criar").style.display = "none";
      }
    }

    function mask(o, f) {
      setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
          o.value = v;
        }
      }, 1);
    }

    function mphone(v) {
      var r = v.replace(/\D/g, "");
      r = r.replace(/^0/, "");
      if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
      } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
      } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
      } else {
        r = r.replace(/^(\d*)/, "($1");
      }
      return r;
    }

    function TelCadastrados() {
      qtdTelefones.forEach(element => {
        Render(element.id, element.numero, element.DDI, true, true)
      })
       
    }

    TelCadastrados();

    function AdicionarNovosTelefones(id) {
      id++;
      Render(id, "", "", false, false);

      if (document.querySelectorAll(".form-group").length >= 4) {
        document.getElementById("criar").style.display = "none";
      }

    }

    async function DeletarTelefone(id) {
      
      //verificar se o input esta com leitura vazio ou nao para mudar o metodo de deletar
      const tel = document.getElementById(`telefone${id}`)

      if (tel.value != "" && tel.disabled == true) {

        await Swal.fire({
          title: "Aviso!",
          text: "Você tem certeza que deseja excluir esse item?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sim, excluir!",
          cancelButtonText: "Não, cancelar!"
        }).then(async (result) => {
          if (result.isConfirmed) {
            try {
              const response = await fetch('./actions/telefones/excluir_telefone.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  id: id
                })
              });

              const data = await response.json();
              if (data.status == "sucesso") {
                let grupo = document.getElementById(`grupo${id}`);
                grupo.remove();

                if (document.querySelectorAll(".form-group").length < 4) {
                  document.getElementById("criar").style.display = "block";
                }
              } else {
                console.log(data.msg);
              }
            } catch (error) {
              console.log(error);
            }

          }
        });
      } else {

        let grupo = document.getElementById(`grupo${id}`);
        grupo.remove();

        if (document.querySelectorAll(".form-group").length < 4) {
          document.getElementById("criar").style.display = "block";
        }
      }
    }

    async function CadastrarTelefone(id) {

      // id++
      // let telefone = document.getElementById(`telefone${id}`)?.value ?? "";
      // let ddi = document.getElementById(`ddi${id}`)?.value ?? "";

      // if (telefone == "" || ddi == "" || id == "" ) {
      //   Swal.fire({
      //     icon: 'error',
      //     title: 'Oops...',
      //     text: 'Preencha todos os campos!',
      //     confirmButtonColor: '#d33',
      //     confirmButtonText: 'Ok'
      //   })
      //   return
      // }
      // try {
      //   const response = await fetch('./actions/telefones/cadastrar_telefones.php', {
      //     method: 'POST',
      //     headers: {
      //       'Content-Type': 'application/json'
      //     },
      //     body: JSON.stringify({
      //       telefone: telefone,
      //       ddi: ddi
      //     })
      //   });

      //   const resultado = await response.json();

      //   if (resultado.status == "sucesso") {
      //     let telefone1 = document.getElementById(`telefone${id}`);
      //     let ddi1 = document.getElementById(`ddi${id}`);
      //     ddi1.setAttribute("disabled", true);
      //     telefone1.setAttribute("disabled", true);
      //   } else {
      //     console.log(resultado.msg);
      //   }
      // } catch (error) {
      //   console.log(error);
      // }
    }

    function EditarTelefone(id) {
      let telefone = document.getElementById(`telefone${id}`);
      let ddi = document.getElementById(`ddi${id}`);
      let editar = document.getElementById(`editar${id}`);
      let salvar = document.getElementById(`salvar${id}`);
      telefone.removeAttribute("disabled");
      ddi.removeAttribute("disabled");
      editar.setAttribute("hidden", true);
      salvar.removeAttribute("hidden");
    }

    async function SalvarTelefone(id) {

      const telefone = document.getElementById(`telefone${id}`)?.value ?? "";
      const ddi = document.getElementById(`ddi${id}`)?.value ?? "";

      if (telefone == "" || ddi == "" || empty(id)) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Preencha todos os campos!',
          confirmButtonColor: '#d33',
          confirmButtonText: 'Ok'
        })
        return
      }

      try {
        const response = await fetch('./actions/telefones/editar_telefones.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: id,
            telefone: telefone,
            ddi: ddi
          })
        });

        const resultado = await response.json();

        if (resultado.status == "sucesso") {
          let telefone = document.getElementById(`telefone${id}`);
          telefone.setAttribute("disabled", true);
          let ddi = document.getElementById(`ddi${id}`);
          ddi.setAttribute("disabled", true);
          let editar = document.getElementById(`editar${id}`);
          editar.removeAttribute("hidden");
          let salvar = document.getElementById(`salvar${id}`);
          salvar.setAttribute("hidden", true);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo deu errado!',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
          })
        }

      } catch (erro) {
        console.error("Erro ao salvar:", erro);
      }

    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>