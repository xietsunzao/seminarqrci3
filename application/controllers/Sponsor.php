<?php

class Sponsor extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        $this->load->model('Sponsor_model', 'sp');
    }

    public function index()
    {
        $title = 'Data Sponsor';
        $get_data = $this->sp->get_data();
        $attradd = array('class' => 'btn  btn-gradient-success');
        $btnadd = anchor('sponsor/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        $data = array(
            'sponsor' => $get_data,
            'title' => $title,
            'btntambah' => $btnadd
        );
        $this->template->load('template/template_v', 'sponsor/sponsor_v', $data);
    }

    public function add()
    {
        $title = 'Tambah Sponsor';
        $parent = 'Data Sponsor';

        $attr_form = array(
            'class' => 'needs-validation',
            'novalidate' => 'novalidate'
        );

        $attr_nama = array(
            'type' => 'text',
            'name' => 'nama_sponsor',
            'class' => 'form-control',
            'value' => set_value('nama_sponsor'),
            'required' => 'required'
        );

        $attr_seminar = array(
            'id' => 'seminar',
            'class' => 'form-control'
        );

        $attr_foto = array(
            'type' => 'file',
            'name' => 'foto',
            'value' => set_value('foto'),
            'placeholder' => 'foto',
            'id' => 'input-file-now',
            'class' => 'dropify',
        );

        $attr_id = array(
            'type' => 'hidden',
            'id' => 'id_sponsor',
            'value' => set_value('id_sponsor')
        );


        $attr_submit = array(
            'id' => 'submit',
            'class' => 'btn btn-gradient-info'
        );

        $get_seminar = $this->sp->get_seminar();
        $form_open = form_open_multipart('sponsor/addaction', $attr_form);
        $form_close = form_close();
        $label_nama = form_label('Nama Sponsor', 'nama_sponsor');
        $label_seminar = form_label('Seminar', 'seminar');
        $label_foto = form_label('Gambar Sponsor', 'foto');
        $input_nama = form_input($attr_nama);
        $input_id = form_input($attr_id);
        $invalid_nama = 'Nama Sponsor harus diisi!';

        $seminar = array();
        foreach ($get_seminar as $s) {
            $seminar[$s->id_seminar] = $s->nama_seminar;
        }
        $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar'), $attr_seminar);
        $input_foto = form_input($attr_foto);
        $fe_nama = form_error('nama_sponsor');
        $submit = form_submit('Simpan', 'submit', $attr_submit);
        $data = array(
            'title' => $title,
            'parent' => $parent,
            'form_open' => $form_open,
            'form_close' => $form_close,
            'label_nama' => $label_nama,
            'label_seminar' => $label_seminar,
            'label_foto' => $label_foto,
            'input_nama' => $input_nama,
            'ddseminar' => $ddseminar,
            'input_foto' => $input_foto,
            'fe_nama' => $fe_nama,
            'input_id' => $input_id,
            'submit' => $submit,
            'invalid_nama' => $invalid_nama,
        );
        $this->template->load('template/template_v', 'sponsor/sponsor_form', $data);
    }

    public function addaction()
    {
        $this->_rules();
        $validasi = $this->form_validation->run();
        if ($validasi == FALSE) {
            $this->add();
        } else {
            $config['upload_path']   = FCPATH . '/uploads/sponsor/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']  = '1000';
            $config['max_width']  = '5000';
            $config['max_height']  = '5000';
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $nama_sponsor = $this->input->post('nama_sponsor', TRUE);
                $seminar = $this->input->post('seminar', TRUE);
                $foto = $this->upload->data('file_name', TRUE);
                $data = array(
                    'nama_sponsor' => $nama_sponsor,
                    'id_seminar' => $seminar,
                    'gambar' => $foto,
                );
                $this->sp->insert_data($data);
                $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                redirect('sponsor');
            }
        }
    }

    
    public function update($id)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->sp->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $nama_sponsor =  $row->nama_sponsor;
            $id_sponsor = $row->id_sponsor;
            $id_seminar = $row->id_seminar;
            $foto = $row->gambar;
            $title = 'Edit Sponsor';
            $parent = 'Data Sponsor';

            $attr_form = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );

            $attr_nama = array(
                'type' => 'text',
                'name' => 'nama_sponsor',
                'class' => 'form-control',
                'value' => set_value('nama_sponsor', $nama_sponsor),
                'required' => 'required'
            );

            $attr_seminar = array(
                'id' => 'seminar',
                'class' => 'form-control'
            );

            $attr_foto = array(
                'type' => 'file',
                'name' => 'foto',
                'value' => set_value('lampiran'),
                'placeholder' => 'Lampiran',
                'id' => 'input-file-now',
                'class' => 'dropify',
            );

            $attr_id = array(
                'type' => 'hidden',
                'name' => 'id_sponsor',
                'id' => 'id_sponsor',
                'value' => set_value('id_sponsor', $id_sponsor)
            );


            $attr_submit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            $get_seminar = $this->sp->get_seminar();
            $form_open = form_open_multipart('sponsor/editaction', $attr_form);
            $form_close = form_close();
            $label_nama = form_label('Nama Sponsor', 'nama_sponsor');
            $label_seminar = form_label('Seminar', 'seminar');
            $label_foto = form_label('Foto Sponsor', 'foto');
            $input_nama = form_input($attr_nama);
            $input_id = form_input($attr_id);
            $invalid_nama = 'Nama Sponsor harus diisi!';

            $seminar = array();
            foreach ($get_seminar as $s) {
                $seminar[$s->id_seminar] = $s->nama_seminar;
            }
            $ddseminar = form_dropdown('seminar', $seminar, set_value('seminar', $id_seminar), $attr_seminar);
            $input_foto = form_input($attr_foto);
            $fe_nama = form_error('nama_sponsor');
            $submit = form_submit('Simpan', 'submit', $attr_submit);
            $data = array(
                'title' => $title,
                'parent' => $parent,
                'form_open' => $form_open,
                'form_close' => $form_close,
                'label_nama' => $label_nama,
                'label_seminar' => $label_seminar,
                'label_foto' => $label_foto,
                'input_nama' => $input_nama,
                'ddseminar' => $ddseminar,
                'input_foto' => $input_foto,
                'fe_nama' => $fe_nama,
                'input_id' => $input_id,
                'submit' => $submit,
                'invalid_nama' => $invalid_nama,
            );
            $this->template->load('template/template_v', 'sponsor/sponsor_form', $data);
        }
    }

    public function editaction()
    {
        $id = $this->input->post('id_sponsor', TRUE);
        $nama_sponsor = $this->input->post('nama_sponsor', TRUE);
        $seminar = $this->input->post('seminar', TRUE);
        $this->_rules();
        $validasi = $this->form_validation->run();
        if ($validasi == FALSE) {
            $this->update($id);
        } else {
            $config['upload_path']   = FCPATH . '/uploads/sponsor/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']  = '1000';
            $config['max_width']  = '5000';
            $config['max_height']  = '5000';
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $data = array(
                    'nama_sponsor' => $nama_sponsor,
                    'id_seminar' => $seminar,
                );
                $this->sp->update_data($id, $data);
                $this->session->set_flashdata('success', 'Data berhasil diubah!');
                redirect('sponsor');
            } else {
                $foto = $this->upload->data('file_name', TRUE);
                $get_foto = $this->sp->get_row($id)->row()->gambar;
                $folder = FCPATH . '/uploads/sponsor/';
                $uploads = $folder . $get_foto;
                if (unlink($uploads)) { } else {
                    $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
                }
                $data = array(
                    'nama_sponsor' => $nama_sponsor,
                    'id_seminar' => $seminar,
                    'gambar' => $foto,
                );
                $this->sp->update_data($id, $data);
                $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                redirect('sponsor');
            }
        }
    }

    public function delete($id)
    {
        $id = $this->uri->segment(3);
        $get_foto = $this->sp->get_row($id)->row()->gambar;
        $folder = FCPATH . '/uploads/sponsor/';
        $uploads = $folder . $get_foto;
        if (unlink($uploads)) { } else {
            $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
        }
        $this->sp->delete_data($id);
        redirect('sponsor');
    }

    public function _rules()
    {
        $attr_nama = array(
            'required' => 'Nama Sponsor harus di isi!',
        );
        $this->form_validation->set_rules('nama_sponsor', 'Nama sponsor', 'trim|required', $attr_nama);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
