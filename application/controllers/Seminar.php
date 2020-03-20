<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Seminar
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Jeff Maruli <jefrimaruli@gmail.com>
 * @link      https://github.com/xietsunzao/
 * @param     ...
 * @return    ...
 *
 */



class Seminar extends CI_Controller
{

    /**
     * __construct.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 21st, 2019.
     * @access	public
     * @return	void
     */
    public function __construct()
    {
        /**
         * @var		mixed	parent
         */
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }        $this->load->model('Seminar_model', 'sm');
    }

    /**
     * index.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 21st, 2019.
     * @access	public
     * @return	void
     */
    public function index()
    {
        /**
         * @param	string	'btn  btn-gradient-success'	
         * @return	void
         */
        $attradd = array('class' => 'btn  btn-gradient-success');
        /**
         * $tambahdata.
         *
         * @param	string	'mahasiswa/add'                                    	
         * @param	string	'<i class="feather icon-user-plus"></i>Tambah Data'	
         * @param	mixed 	$attradd                                           	
         * @return	void
         */ /**
         * anonymouse class.
         *
         * @since	v0.0.1
         * @version	v1.0.0	Thursday, November 21st, 2019.
         */
        $tambahdata = anchor('seminar/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        /**
         * @var		mixed	$this->sm->get_data()
         */
        $seminar = $this->sm->get_data();
        /**
         * @var		string	$title
         */
        $title = "Data Seminar";

        /**
         * $data.
         *
         * @var		mixed	$data
         */
        $data = array(
            'seminar' =>  $seminar,
            'title' => $title,
            'btntambah' => $tambahdata,
        );
        $this->template->load('template/template_v', 'seminar/seminar_v', $data);
    }

    /**
     * detail.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 25th, 2019.	
     * @version	v1.0.1	Thursday, November 28th, 2019.
     * @access	public
     * @param	mixed	$id	Default: NULL
     * @return	void
     */
    public function detail($id)
    {
        /**
         * 
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->sm->get_row($id)
         */
        $get_row  = $this->sm->get_row($id);
        if ($get_row->num_rows() > 0) {
            /**
             * @var		mixed	$get_row->row()
             */
            $seminar_box = $this->seminar_box();
            $row = $get_row->row();
            $get_pembicara = $this->sm->get_pembicara($id);
            $get_sponsor = $this->sm->get_sponsor($id);
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $tgl_pelaksanaan = $row->tgl_pelaksana;
            $harga_tiket = $row->harga_tiket;
            $lampiran = $row->lampiran;
            $foto_tiket = $row->lampiran_tiket;
            $parent = "Data Seminar";
            $title = "Detail Seminar";
            $tiket = "Tiket Seminar";
            $data = array(
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'tgl_pelaksanaan' => $tgl_pelaksanaan,
                'harga_tiket' => $harga_tiket,
                'foto_tiket' => $foto_tiket,
                'lampiran' => $lampiran,
                'title' => $title,
                'pembicara' => $get_pembicara,
                'sponsor' => $get_sponsor,
                'seminar_box' => $seminar_box,
                'parent' => $parent,
                'tiket' => $tiket,
            );
            $this->template->load('template/template_v', 'seminar/seminar_d', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data tidak tersedia!');
            redirect('seminar');
        }
    }

    public function seminar_box()
    {
        $id = $this->uri->segment(3);
        $total_tiket = $this->sm->total_tiket($id)->row()->slot_tiket;
        $tiket_terjual = $this->sm->tiket_terjual($id);
        $total_peserta = $tiket_terjual;
        $sisa_tiket = intval($total_tiket) - intval($tiket_terjual);

        $box = [
            [
                'color'         => 'red',
                'total'     => $total_tiket,
                'title'        => 'Slot Tiket',
                'icon'        => 'list'
            ],
            [
                'color'         => 'blue',
                'total'     => $tiket_terjual,
                'title'        => 'Tiket Terjual',
                'icon'        => 'id-card'
            ],
            [
                'color'         => 'green',
                'total'     => $sisa_tiket,
                'title'        => 'Sisa Tiket',
                'icon'        => 'id-card'
            ],
            [
                'color'         => 'yellow',
                'total'     => $total_peserta,
                'title'        => 'Total Peserta',
                'icon'        => 'users'
            ],
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }

    /**
     * add.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 21st, 2019.	
     * @version	v1.0.1	Saturday, November 23rd, 2019.	
     * @version	v1.0.2	Friday, November 29th, 2019.
     * @access	public
     * @return	mixed
     */
    public function add()
    {
        /**
         * FORM
         *
         * @var		string	$attr_form
         */
        $attr_form = 'seminar/addaction';
        $opt_form = array(
            'id' => 'fileupload',
        );
        /**
         * $formopen.
         *
         * @param	mixed	$attr_form	
         * @return	void
         */
        $formopen = form_open_multipart($attr_form, $opt_form);
        /**
         * $formclose.
         *
         * @return	void
         */
        $formclose = form_close();

        /**
         * @var		mixed	$paren
         */
        $parent  = 'Data Seminar';
        /**
         * Label
         *
         * @param	string	'Nama Seminar'	
         * @param	string	'nama_seminar'	
         * @return	void
         */
        $lnama_seminar = form_label('Nama Seminar', 'nama_seminar');
        /**
         * $ltgl_pelaksana.
         *
         * @param	string	'Tanggal Pelaksaan'	
         * @param	string	'tgl_laksana'      	
         * @return	void
         */
        $ltgl_pelaksanaan = form_label('Tanggal Pelaksaan', 'tgl_laksana');
        /**
         * $lharga_tiket.
         *
         * @param	string	'Harga Tiket'	
         * @param	string	'harga_tiket'	
         * @return	void
         */
        $lharga_tiket = form_label('Harga Tiket', 'harga_tiket');
        /**
         * $llampiran.
         *
         * @param	string	'Lampiran'	
         * @param	string	'lampiran'	
         * @return	void
         */
        $llampiran = form_label('Lampiran', 'input-file-now');
        /**
         * $lpembicara.
         *
         * @param	string	'Pembicara'     	
         * @param	string	'input-file-now'	
         * @return	void
         */
        $lpembicara = form_label('Pembicara', 'input-file-now', ['class' => 'pembicara']);
        /**
         * ATTRIBUTE
         *
         * @var		mixed	$attr_namaseminar
         */
        $attr_namaseminar = array(
            'type' => 'text',
            'name' => 'nama_seminar',
            'id' => 'nama_seminar',
            'value' => set_value('nama_seminar'),
            'placeholder' => 'Nama Seminar',
            'class' => 'form-control'
        );
        /**
         * @var		mixed	$attr_tgllaksana
         */
        $attr_tgllaksana = array(
            'type' => 'text',
            'name' => 'tanggal_pelaksanaan',
            'id' => 'tanggal_pelaksanaan',
            'value' => set_value('tanggal_pelaksanaan'),
            'placeholder' => 'Tanggal Pelaksanaan',
            'class' => 'form-control'
        );
        
        /**
         * @var		mixed	$attr_lampiran
         */
        $attr_lampiran = array(
            'type' => 'file',
            'name' => 'lampiran',
            'value' => set_value('lampiran'),
            'placeholder' => 'Lampiran',
            'id' => 'input-file-now',
            'class' => 'dropify',
        );

        /**
         * @var		mixed	$attr_pembicara
         */
        $attr_pembicara = array(
            'type' => 'file',
            'name' => 'pembicara[]',
            'value' => set_value('pembicara'),
            'placeholder' => 'pembicara',
            'id' => 'input-file-now',
            'class' => 'dropify',
        );

        /**
         * @var		mixed	$attr_submit
         */
        $attr_submit = array(
            'id' => 'submit',
            'class' => 'btn btn-gradient-info'
        );

        /**
         * @var		mixed	$attr_idseminar
         */
        $attr_idseminar = array(
            'type' => 'hidden',
            'name' => 'id_seminar',
            'value' => set_value('id_seminar'),
        );

        /**
         * FORM INPUT
         *
         * @var		mixed	form_input($attr_namaseminar)
         */
        $i_namaseminar =  form_input($attr_namaseminar);
        /**
         * $i_tglpelaksanaan.
         *
         * @param	mixed	$attr_tgllaksana	
         * @return	void
         */
        $i_tglpelaksanaan = form_input($attr_tgllaksana);
        /**
         * $i_hargatiket.
         *
         * @param	mixed	$attr_hargatiket	
         * @return	void
         */
        /**
         * $i_lampiran.
         *
         * @param	mixed	$attr_lampiran	
         * @return	void
         */
        $i_lampiran = form_input($attr_lampiran);

        /**
         * $i_pembicara.
         *9.
         * @param	mixed	$attr_pembicara	
         * @return	void
         */
        $i_pembicara = form_input($attr_pembicara);
        /**
         * $i_idlampiran.
         *
         * @param	mixed	$attr_idseminar	
         * @return	void
         */
        $i_idseminar = form_input($attr_idseminar);
        /**
         * SUBMIT BUTTON
         *
         * @param	string	'submit'   	
         * @param	string	'Simpan'   	
         * @param	mixed 	$attrsubmit	
         * @return	void
         */
        $submit = form_submit('submit', 'Simpan', $attr_submit);
        /**
         * FORM ERROR
         *	
         * @param	string	'nama_seminar'	
         * @return	void
         */
        $fe_namaseminar = form_error('nama_seminar');
        /**
         * $fe_tglpelaksanaan.
         *
         * @param	string	'tgl_pelaksanaan'	
         * @return	void
         */
        $fe_tglpelaksanaan = form_error('tgl_pelaksanaan');
        /**
         * $fe_hargatiket.
         *
         * @param	string	'harga_tiket'	
         * @return	void
         */
        $fe_hargatiket = form_error('harga_tiket');
        /**
         * @var		string	$title
         */
        $title = "Tambah Data";
        /**
         * @var		mixed	$data
         */
        $data = array(
            'title' => $title,
            'lnama_seminar' => $lnama_seminar,
            'ltgl_pelaksanaan' => $ltgl_pelaksanaan,
            'lharga_tiket' => $lharga_tiket,
            'llampiran' => $llampiran,
            'lpembicara' => $lpembicara,
            'i_namaseminar' => $i_namaseminar,
            'i_tglpelaksanaan' => $i_tglpelaksanaan,
            'i_lampiran' => $i_lampiran,
            'i_pembicara' => $i_pembicara,
            'i_idseminar' => $i_idseminar,
            'fe_namaseminar' => $fe_namaseminar,
            'fe_tglpelaksanaan' => $fe_tglpelaksanaan,
            'fe_hargatiket' => $fe_hargatiket,
            'formopen' => $formopen,
            'formclose' => $formclose,
            'submit' => $submit,
            'parent' => $parent,
        );
        $this->template->load('template/template_v', 'seminar/seminar_form', $data);
    }

    /**
     * addaction.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Friday, November 22nd, 2019.
     * @access	public
     * @return	void
     */

    public function uploadaction()
    {
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler");
        $file = $this->input->get('file');
        if (isset($file)) {
            $fcpatht = FCPATH . '/uploads/pembicara/';
            $fcpathth = FCPATH . '/uploads/pembicara/thumbnail/';
            $thumbnail = ($fcpathth . $file);
            $tiket = ($fcpatht . $file);
            if (unlink($tiket) && unlink($thumbnail)) { } else {
                echo "error";
            }
        }
    }

    public function addaction()
    {
        /**
         * @var		mixed	$this->_rules()
         */
        $this->_rules();
        /**
         * @var		mixed	$this->form_validation->run()
         */
        $validasi = $this->form_validation->run();
        if ($validasi ==  FALSE) {
            /**
             * @var		mixed	$this->add()
             */
            $this->add();
        } else {
            $config['upload_path']   = FCPATH . '/uploads/poster/';
            $config['allowed_types'] = 'gif|jpg|png';
            /**
             * @var		mixed	$config['max_size']
             */
            $config['max_size']  = '1000';
            /**
             * @var		mixed	$config['max_width']
             */
            $config['max_width']  = '5000';
            /**
             * @var		mixed	$config['max_height']
             */
            $config['max_height']  = '5000';
            /**
             * @var		mixed	$config['overwrite']
             */
            $config['overwrite'] = TRUE;
            /**
             * @var		mixed	$config['remove_spaces']
             */
            $config['remove_spaces'] = TRUE;
            /**
             * @var		mixed	$config['encrypt_name']
             */
            $config['encrypt_name'] = TRUE;
            /**
             * @var		mixed	$this->upload->initialize($config)
             */
            $this->upload->initialize($config);
            /**
             * @var		mixed	!$this->upload->do_upload('lampiran
             */
            if (!$this->upload->do_upload('lampiran')) {
                /**
                 * @var		mixed	$this->session->set_flashdata('warning'
                 */ /**
                 * @var		mixed	$this->upload->display_errors())
                 */
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                /**
                 * @var		mixed	redirect($_SERVER['HTTP_REFERER'])
                 */
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                /**
                 * @var		mixed	$this->input->post('nama_seminar'
                 */ /**
                 * @var		mixed	TRUE)
                 */
                $nama_seminar = $this->input->post('nama_seminar', TRUE);
                /**
                 * @var		mixed	$this->input->post('tanggal_pelaksanaan'
                 */ /**
                 * @var		mixed	TRUE)
                 */
                $tanggal_pelaksanaan = $this->input->post('tanggal_pelaksanaan', TRUE);
                /**
                 * @var		mixed	$this->input->post('harga_tiket'
                 */ /**
                 * @var		mixed	TRUE)
                 */
                $harga_tiket = $this->input->post('harga_tiket', TRUE);
                /**
                 * @var		mixed	$this->upload->data('file_name'
                 */ /**
                 * @var		mixed	TRUE)
                 */
                $lampiran = $this->upload->data('file_name', TRUE);
                /**
                 * $hrg_tkt.
                 *
                 * @param	array 	['.','Rp'.'.']	
                 * @param	string	''            	
                 * @param	mixed 	$harga_tiket  	
                 * @return	void
                 */
                $hrg_tkt = str_replace(['.', 'Rp'], '', $harga_tiket);
                /**
                 * @var		mixed	$data
                 */
                $data = array(
                    'nama_seminar' => $nama_seminar,
                    'tgl_pelaksana' => $tanggal_pelaksanaan,
                    'lampiran' => $lampiran,
                );
                /**
                 * @var		mixed	$this->sm->insert_data($data)
                 */
                $this->sm->insert_data($data);
                $this->session->set_flashdata('success', 'Data berhasil disimpan!');
                /**
                 * @var		mixed	redirect('seminar'
                 */ /**
                 * @var		mixed	refresh')
                 */
                redirect('seminar', 'refresh');
            }
        }
    }

    /**
     * udpate data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Saturday, November 23rd, 2019.	
     * @version	v1.0.1	Saturday, November 23rd, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	void
     */
    public function update($id)
    {
        /**
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->sm->get_row($id)
         */
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {

            /**
             * @var		mixed	$get_row->row()
             */
            $row = $get_row->row();

            // GET ROW 
            /**
             * @var		mixed	$row->id_seminar
             */
            $id_seminar = $row->id_seminar;
            /**
             * @var		mixed	$row->nama_seminar
             */
            $nama_seminar = $row->nama_seminar;
            /**
             * @var		mixed	$row->tgl_laksana
             */
            $tgl_laksana = $row->tgl_pelaksana;
            /**
             * @var		mixed	$row->harga_tiket
             */
            /**
             * @var		mixed	$row->lampiran
             */
            $lampiran = $row->lampiran;
            /**
             * FORM
             *
             * @var		string	$attr_form
             */
            $attr_form = 'seminar/editaction';
            /**
             * $formopen.
             *
             * @param	mixed	$attr_form	
             * @return	void
             */
            $formopen = form_open_multipart($attr_form);
            /**
             * $formclose.
             *
             * @return	void
             */
            $formclose = form_close();

            /**
             * @var		mixed	$paren
             */
            $parent  = 'Data Seminar';
            /**
             * Label
             *
             * @param	string	'Nama Seminar'	
             * @param	string	'nama_seminar'	
             * @return	void
             */
            $lnama_seminar = form_label('Nama Seminar', 'nama_seminar');
            /**
             * $ltgl_pelaksana.
             *
             * @param	string	'Tanggal Pelaksaan'	
             * @param	string	'tgl_laksana'      	
             * @return	void
             */
            $ltgl_pelaksanaan = form_label('Tanggal Pelaksaan', 'tgl_laksana');
            /**
             * $lharga_tiket.
             *
             * @param	string	'Harga Tiket'	
             * @param	string	'harga_tiket'	
             * @return	void
             */
            $lharga_tiket = form_label('Harga Tiket', 'harga_tiket');
            /**
             * $llampiran.
             *
             * @param	string	'Lampiran'	
             * @param	string	'lampiran'	
             * @return	void
             */
            $llampiran = form_label('Lampiran', 'input-file-now');
            /**
             * @var		string	$title
             */
            /**
             * ATTRIBUTE
             *
             * @var		mixed	$attr_namaseminar
             */
            $attr_namaseminar = array(
                'type' => 'text',
                'name' => 'nama_seminar',
                'id' => 'nama_seminar',
                'value' => set_value('nama_seminar', $nama_seminar),
                'placeholder' => 'Nama Seminar',
                'class' => 'form-control'
            );
            /**
             * @var		mixed	$attr_tgllaksana
             */
            $attr_tgllaksana = array(
                'type' => 'text',
                'name' => 'tanggal_pelaksanaan',
                'id' => 'tanggal_pelaksanaan',
                'value' => set_value('tanggal_pelaksanaan', $tgl_laksana),
                'placeholder' => 'Tanggal Pelaksanaan',
                'class' => 'form-control'
            );
            /**
             * @var		mixed	$attr_hargatiket
             */
            /**
             * @var		mixed	$attr_lampiran
             */
            $attr_lampiran = array(
                'type' => 'file',
                'name' => 'lampiran',
                'value' => set_value('lampiran'),
                'placeholder' => 'Lampiran',
                'id' => 'input-file-now',
                'class' => 'dropify',
            );

            /**
             * @var		mixed	$attr_submit
             */
            $attr_submit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            /**
             * @var		mixed	$attr_idseminar
             */
            $attr_idseminar = array(
                'type' => 'hidden',
                'name' => 'id_seminar',
                'value' => set_value('id_seminar', $id_seminar),
            );

            /**
             * FORM INPUT
             *
             * @var		mixed	form_input($attr_namaseminar)
             */
            $i_namaseminar =  form_input($attr_namaseminar);
            /**
             * $i_tglpelaksanaan.
             *
             * @param	mixed	$attr_tgllaksana	
             * @return	void
             */
            $i_tglpelaksanaan = form_input($attr_tgllaksana);
            /**
             * $i_hargatiket.
             *
             * @param	mixed	$attr_hargatiket	
             * @return	void
             */
            /**
             * $i_lampiran.
             *
             * @param	mixed	$attr_lampiran	
             * @return	void
             */
            $i_lampiran = form_input($attr_lampiran);
            /**
             * $i_idlampiran.
             *
             * @param	mixed	$attr_idseminar	
             * @return	void
             */
            $i_idseminar = form_input($attr_idseminar);
            /**
             * SUBMIT BUTTON
             *
             * @param	string	'submit'   	
             * @param	string	'Simpan'   	
             * @param	mixed 	$attrsubmit	
             * @return	void
             */
            $submit = form_submit('submit', 'Simpan', $attr_submit);
            /**
             * FORM ERROR
             *	
             * @param	string	'nama_seminar'	
             * @return	void
             */
            $fe_namaseminar = form_error('nama_seminar');
            /**
             * $fe_tglpelaksanaan.
             *
             * @param	string	'tgl_pelaksanaan'	
             * @return	void
             */
            $fe_tglpelaksanaan = form_error('tgl_pelaksanaan');
            /**
             * $fe_hargatiket.
             *
             * @param	string	'harga_tiket'	
             * @return	void
             */
            $fe_hargatiket = form_error('harga_tiket');
            /**
             * @var		string	$title
             */
            $title = "Update Data";
            /**
             * @var		mixed	$data
             */
            $data = array(
                'title' => $title,
                'lnama_seminar' => $lnama_seminar,
                'ltgl_pelaksanaan' => $ltgl_pelaksanaan,
                'lharga_tiket' => $lharga_tiket,
                'llampiran' => $llampiran,
                'i_namaseminar' => $i_namaseminar,
                'i_tglpelaksanaan' => $i_tglpelaksanaan,
                'i_lampiran' => $i_lampiran,
                'i_idseminar' => $i_idseminar,
                'fe_namaseminar' => $fe_namaseminar,
                'fe_tglpelaksanaan' => $fe_tglpelaksanaan,
                'fe_hargatiket' => $fe_hargatiket,
                'formopen' => $formopen,
                'formclose' => $formclose,
                'submit' => $submit,
                'parent' => $parent,
            );
            $this->template->load('template/template_v', 'seminar/seminar_form', $data);
        }
    }

    /**
     * editaction.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, November 24th, 2019.
     * @access	public
     * @return	void
     */
    public function editaction()
    {
        /**
         * @var		mixed	$this->input->post('id_seminar'
         */ /**
         * @var		mixed	TRUE)
         */
        $id = $this->input->post('id_seminar', TRUE);
        /**
         * @var		mixed	$this->input->post('nama_seminar'
         */ /**
         * @var		mixed	TRUE)
         */
        $nama_seminar = $this->input->post('nama_seminar', TRUE);
        /**
         * @var		mixed	$this->input->post('tanggal_pelaksanaan')
         */
        $tanggal_pelaksanaan = $this->input->post('tanggal_pelaksanaan');
        /**
         * @var		mixed	$this->input->post('harga_tiket')
         */
        $harga_tiket = $this->input->post('harga_tiket');
        /**
         * $hrg_tkt.
         *
         * @param	array 	['.', 'Rp', '.00']	
         * @param	string	''                	
         * @param	mixed 	$harga_tiket      	
         * @return	void
         */
        $hrg_tkt = str_replace(['.', 'Rp'], '', $harga_tiket);
        /**
         * @var		mixed	$this->_rules()
         */
        $this->_rules();
        /**
         * @var		mixed	$this->form_validation->run()
         */
        $validation = $this->form_validation->run();
        /**
         * @var		mixed	$validatio
         */
        if ($validation == FALSE) {
            /**
             * @var		mixed	$this->update($id)
             */
            $this->update($id);
        } else {
            $config['upload_path']   = FCPATH . '/uploads/poster/';
            /**
             * @var		string	$config['allowed_types']
             */
            $config['allowed_types'] = 'gif|jpg|png';
            /**
             * @var		mixed	$config['max_size']
             */
            $config['max_size']  = '1000';
            /**
             * @var		mixed	$config['max_width']
             */
            $config['max_width']  = '5000';
            /**
             * @var		mixed	$config['max_height']
             */
            $config['max_height']  = '5000';
            /**
             * @var		mixed	$config['overwrite']
             */
            $config['overwrite'] = TRUE;
            /**
             * @var		mixed	$config['remove_spaces']
             */
            $config['remove_spaces'] = TRUE;
            /**
             * @var		mixed	$config['encrypt_name']
             */
            $config['encrypt_name'] = TRUE;
            /**
             * @var		mixed	$this->upload->initialize($config)
             */
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('lampiran')) {
                /**
                 * @var		mixed	$data
                 */
                $data = array(
                    'nama_seminar' => $nama_seminar,
                    'tgl_pelaksana' => $tanggal_pelaksanaan,
                );
                /**
                 * @var		mixed	$this->sm->update_data($id
                 */ /**
                 * @var		mixed	$data)
                 */
                $this->sm->update_data($id, $data);
                /**
                 * @var		mixed	$this->session->set_flashdata('success'
                 */ /**
                 * @var		mixed	!')
                 */
                $this->session->set_flashdata('success', 'Data Berhasil di ubah!');
                /**
                 * @var		mixed	redirect('seminar'
                 */ /**
                 * @var		mixed	refresh')
                 */
                redirect('seminar', 'refresh');
            } else {
                /**
                 * @var		mixed	$this->upload->data('file_name')
                 */
                $lampiran = $this->upload->data('file_name');
                /**
                 * @var		mixed	$this->sm->get_row($id)->row()->lampiran
                 */
                $get_lampiran = $this->sm->get_row($id)->row()->foto;
                $folder = FCPATH . '/uploads/poster/';
                /**
                 * @var		mixed	$get_lampiran
                 */
                $uploads = $folder . $get_lampiran;
                if (unlink($uploads)) { } else {
                    $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
                }
                /**
                 * @var		mixed	$data
                 */
                $data = array(
                    'nama_seminar' => $nama_seminar,
                    'tgl_pelaksana' => $tanggal_pelaksanaan,
                    'lampiran' => $lampiran,
                );
                /**
                 * @var		mixed	$this->sm->update_data($id
                 */ /**
                 * @var		mixed	$data)
                 */
                $this->sm->update_data($id, $data);
                /**
                 * @var		mixed	$this->session->set_flashdata('success'
                 */ /**
                 * @var		mixed	!')
                 */
                $this->session->set_flashdata('success', 'Data Berhasil di ubah!');
                /**
                 * @var		mixed	redirect('seminar'
                 */ /**
                 * @var		mixed	refresh')
                 */
                redirect('seminar', 'refresh');
            }
        }
    }

    /**
     * delete.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Saturday, November 23rd, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	void
     */
    public function delete($id)
    {
        /**
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->sm->get_row($id)->row()->lampiran
         */
        $get_lampiran = $this->sm->get_row($id)->row()->lampiran;
        $folder = FCPATH . '/uploads/poster/';
        /**
         * @var		mixed	$get_lampiran
         */
        $uploads = $folder . $get_lampiran;
        if (unlink($uploads)) { } else {
            $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
        }
        /**
         * @var		mixed	$this->sm->delete_data($id)
         */
        $this->sm->delete_data($id);
        /**
         * @var		mixed	redirect('seminar'
         */ /**
         * @var		mixed	refresh')
         */
        redirect('seminar', 'refresh');
    }
    /**
     * _rules.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Friday, November 22nd, 2019.
     * @access	public
     * @return	void
     */
    public function _rules()
    {
        /**
         * @var		mixed	$attr_namasemiar
         */
        $attr_namasemiar = array(
            'required' => 'Nama seminar harus di isi!',
        );
        /**
         * @var		mixed	$attr_tglpelaksaan
         */
        $attr_tglpelaksaan = array(
            'tgl_pelaksaan' => 'Tanggal pelaksaan harus di isi!',
        );
        /**
         * @var		mixed	$attr_hargatiket
         */

        $this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'trim|required', $attr_namasemiar);
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'trim|required', $attr_tglpelaksaan);
    }
}

/* End of file Seminar.php */
/* Location: ./application/controllers/Seminar.php */
