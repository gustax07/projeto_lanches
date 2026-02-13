<?php
$id = $_GET['id'];
include('../../classes/usuarios.class.php');
$funcionarios = new Usuarios();
$funcionarios->id = $id;
$usuario = $funcionarios->ListarPorID()[0];

include('../../classes/tipos.class.php');
$tipos = new Tipos();
$tipos_listar = $tipos->Listar();
unset($tipos_listar[0]);

echo "<form action='../actions/funcionarios/editar_funcionarios.php?id=' . $id'"; 
echo "method='post' class='form-floating was-validated' novalidate>";
echo "<div class='form-floating mb-3'>";
echo "<input type='text' class='form-control' name='nome' id='nome' placeholder='Usuario' value='" . $usuario['nome'] . "'required>";
echo "<label for='nome' class='form-label'>Nome</label>";
echo "<div class='invalid-feedback'>";
echo "Esse campo é obrigatório";
echo "</div>";
echo "</div>";
echo "<div class='form-floating mb-3'>";
echo "<input type='email' class='form-control' name='email' id='email' placeholder='example@gmail.com' value='" . $usuario['email'] . "'required>";
echo "<label for='email' class='form-label'>Email</label>";
echo "<div class='invalid-feedback'>";
echo "Esse campo é obrigatório";
echo "</div>";
echo "</div>";
echo "<div class='form-floating mb-3'>";
echo "<input type='password' class='form-control' name='senha' id='senha' placeholder='Senha123'>";
echo "<label for='senha' class='form-label'>Senha</label>";
echo "</div>";
echo "<div class='form-floating mb-3'>";
echo "<select class='form-select' name='id_tipo_fk' id='id_tipo_fk' required>";
echo "<option value='' disabled selected>Selecione um cargos</option>";
foreach ($tipos_listar as $t) {
    echo "<option value='" . $t['id'] . "'>" . $t['nome_tipo'] . "</option>";
}
echo "</select>";
echo "<label for='id_cargos' class='form-label'>Selecione um cargos</label>";
echo "</div>";
echo "<div class='modal-footer'>";
echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
echo "<button type='submit' class='btn btn-primary'>Editar</button>";
echo "</div>";
echo "</form>";
?>













                           
                                
                               
                                
<!--                                   
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" value="<?= $usuario['email'] ?>" required>
                                <label for="email" class="form-label">Email</label>
                                <div class="invalid-feedback">
                                    Esse campo é obrigatório
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha123">
                                <label for="senha" class="form-label">Senha</label>

                            </div>
                            <div class="form-floating mb-3">
                                <select class='form-select' name="id_tipo_fk" id="id_tipo_fk" required>
                                    <option value="" disabled selected>Selecione um cargos</option>
                                    <?php foreach ($tipos_listar as $t) { ?>
                                        <option value="<?= $t['id']; ?>" <?= ($t['id'] == $usuario['id_tipo_fk'] ? 'selected' : '') ?>> <?= $t['nome_tipo'] ?></option>
                                    <?php } ?>
                                </select>
                                <label for="id_cargos" class="form-label">Selecione um cargos</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a href="./gerenciar_funcionarios.php?id_tipo_fk=-1"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></a>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                    </form> -->