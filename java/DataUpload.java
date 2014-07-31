//package org.openml.examples.dataupload;

import java.io.File;

import org.openml.apiconnector.algorithms.Conversion;
import org.openml.apiconnector.io.ApiConnector;
import org.openml.apiconnector.io.ApiSessionHash;
import org.openml.apiconnector.settings.Config;
import org.openml.apiconnector.xml.DataSetDescription;
import org.openml.apiconnector.xml.UploadDataSet;
import org.openml.apiconnector.xstream.XstreamXmlMapping;

import com.thoughtworks.xstream.XStream;

public class DataUpload {

	private static final XStream xstream = XstreamXmlMapping.getInstance();
	private static final String USERNAME = "FILL_IN_USERNAME";
	private static final String PASSWORD = "FILL_IN_PASSWORD";
	private static final String SERVER = "http://openml.liacs.nl/";
	private static final String DATASET_PATH = "data/iris.arff";
	private static Config config;
	private final ApiSessionHash ash;
	private final ApiConnector apiconnector;
	public static void main( String[] args ) throws Exception {

		// First create a new config item. Used to identify the URL-endpoint, and authenticate user. 
		config = new Config( "username = " + USERNAME + "; password = " + PASSWORD + "; server = " + SERVER );
		new DataUpload();
	}

	public DataUpload() throws Exception {

		// initiate the apiconnector, using correct url
	apiconnector = new ApiConnector( config.getServer() );

		// initialize the session hash, this will take care of user authentication
		ash = new ApiSessionHash( apiconnector );
		ash.set( config.getUsername(), config.getPassword() );

		// there are various utilities to conveniently initiate an OpenML object.
		// we will use one of these to generate the "description.xml"
		DataSetDescription description = new DataSetDescription( "iris", "An instance of the iris dataset", "arff", "class");

		// The description object is stored in variable description, and can be converted to a file using XStream:
		File descriptionXML = Conversion.stringToTempFile(xstream.toXML(description), "description", "xml");

		// now load the dataset
 	 	File dataset = new File( DATASET_PATH );

		// there is an bijective function between API function names and functions in the java lib.
		// API documentation can be found here: http://openml.liacs.nl/developers
		// The function openml.data.upload has an equavalent apiconnector.openmlDataUpload(File,File,String).

		UploadDataSet result = apiconnector.openmlDataUpload( descriptionXML, dataset, ash.getSessionHash() );

		// variable result contains now an object with the result. Note that it was successful,
		// otherwise an error would have been thrown.

		System.out.println( "New dataset has dataset id: " + result.getId() );
	}
}
