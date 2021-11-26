<div class="col-lg-12">
    <div class="form-group">
        @if ($fieldPageConfig->show('responsible_name'))
        <div class="col-sm-12">
                <label class=" control-label">Nome / Razão Social</label>
            <input type="text" id="responsible_name" name="responsible_name" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_name') !!} />
        </div>
        @endif
    </div>
    <div class="form-group">
        @if ($fieldPageConfig->show('responsible_cpf'))
        <div class="col-sm-6">
                <label class=" control-label">CPF/CNPJ</label>
            <input type="text" id="responsible_cpf" name="responsible_cpf" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_cpf') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_rg'))
        <div class="col-sm-6">
                <label class=" control-label">RG/INsc. Est.</label>
            <input type="text" id="responsible_rg" name="responsible_rg" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_rg') !!} />
        </div>
        @endif
    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_address'))
        <div class="col-sm-10">
                <label class=" control-label">Endereço Cobrança</label>
            <input type="text" id="responsible_address" name="responsible_address" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_address') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_number'))
        <div class="col-sm-2">
                <label class=" control-label">Nº</label>
            <input type="text" id="responsible_number" name="responsible_number" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_number') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_complement'))
        <div class="col-sm-12">
                <label class=" control-label">Complemento</label>
            <input type="text" id="responsible_complement" name="responsible_complement" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_complement') !!} />
        </div>
        @endif
    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_district'))
        <div class="col-sm-4">
                <label class=" control-label">Bairro</label>
            <input type="text" id="responsible_district" name="responsible_district" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_district') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_city'))
        <div class="col-sm-4">
                <label class=" control-label">Cidade</label>
            <input type="text" id="responsible_city" name="responsible_city" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_city') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_state'))
        <div class=" col-lg-2">
            <label>UF </label>
            <select class="form-control m-b" name="responsible_state" required {!! $fieldPageConfig->attr('responsible_state') !!}></select>
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_zip_code'))
        <div class="col-sm-2">
                <label class=" control-label">CEP</label>
            <input type="text" id="responsible_zip_code" name="responsible_zip_code" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_zip_code') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_phone'))
        <div class="col-sm-6">
            <label class=" control-label">Telefone Comercial</label>
            <input type="text" id="responsible_phone" name="responsible_phone" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_phone') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_cel_phone'))
        <div class="col-sm-6">
            <label class=" control-label">Celular Comercial</label>
            <input type="text" id="responsible_cel_phone" name="responsible_cel_phone" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_cel_phone') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_email'))
        <div class="col-sm-12">
            <label class=" control-label">Email Comercial</label>
            <input type="text" id="responsible_email" name="responsible_email" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_email') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_contact_name'))
        <div class="col-sm-12">
            <label class=" control-label">Nome do Contato</label>
            <input type="text" id="responsible_contact_name" name="responsible_contact_name" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_contact_name') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_contact_phone'))
        <div class="col-sm-6">
            <label class=" control-label">Telefone Contato</label>
            <input type="text" id="responsible_contact_phone" name="responsible_contact_phone" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_contact_phone') !!} />
        </div>
        @endif

        @if ($fieldPageConfig->show('responsible_contact_cel_phone'))
        <div class="col-sm-6">
            <label class=" control-label">Celular Contato</label>
            <input type="text" id="responsible_contact_cel_phone" name="responsible_contact_cel_phone" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_contact_cel_phone') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">

        @if ($fieldPageConfig->show('responsible_contact_email'))
        <div class="col-sm-12">
            <label class=" control-label">Email Contato</label>
            <input type="text" id="responsible_contact_email" name="responsible_contact_email" class="form-control" value="" required {!! $fieldPageConfig->attr('responsible_contact_email') !!} />
        </div>
        @endif

    </div>

    <div class="form-group">
        <label>Anotações Importantes:</label>

        @if ($fieldPageConfig->show('responsible_observation'))
        <div class="ibox-content no-padding">
            <textarea name="responsible_observation" class="summernote" {!! $fieldPageConfig->attr('responsible_observation') !!} ></textarea>
        </div>
        @endif

    </div>

</div>
